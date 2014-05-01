<?php

namespace Reporting\Models;

class StaffClasses extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff_classes';

	public function classdetails($class) {
		return \DB::table($this->table)
							->leftJoin('student_class_list', 'student_class_list.class', '=', 'staff_classes.class')
							->join('student_users', 'student_class_list.upn', '=', 'student_users.upn')
							->leftJoin('staff_users', 'staff_classes.upn', '=', 'staff_users.upn')
							->leftJoin('reports_card', function($join){
								$join->on('student_users.upn', '=', 'reports_card.student_upn')
									->on('student_class_list.class', '=', 'reports_card.class_id');
							})
							->select(\DB::raw('staff_users.forename AS staff_forename, 
								staff_users.surname AS staff_surname,
								staff_users.upn AS staff_upn,
								student_users.upn AS student_upn, 
								student_class_list.class as class_id, 
								student_users.forename as student_forename, 
								student_users.surname as student_surname,
								reports_card.comment as report_comment,
								reports_card.staff_completed_at as report_completed_at,
								reports_card.management_confirmed_at as management_confirmed_at,
								reports_card.management_flagged_at as management_flagged_at,
								reports_card.created_at as report_created_at,
								reports_card.id as id, 
								reports_card.flagged_comment as flagged_comment,
								reports_card.modified_since_flagged as modified_since_flagged, 
								CONCAT(LEFT(staff_users.forename, 1), " ", staff_users.surname) AS staff_name'
							  ))
							->where('student_class_list.class', '=', $class)
							->orderBy('student_users.surname');
	}
	public function hodclasses() {
		$query = \DB::table($this->table)
							->leftJoin('student_class_list', 'student_class_list.class', '=', 'staff_classes.class')
							->leftjoin('student_users', 'student_class_list.upn', '=', 'student_users.upn')
							->leftJoin('staff_users', 'staff_classes.upn', '=', 'staff_users.upn')
							->leftJoin('reports_card', function($join){
								$join->on('student_users.upn', '=', 'reports_card.student_upn')
									->on('student_class_list.class', '=', 'reports_card.class_id');
							})
							->select(\DB::raw('staff_classes.class AS class, COUNT(DISTINCT student_users.upn) AS student_count, SUM(if(reports_card.management_confirmed_at IS NOT NULL , 1, 0)) AS confirmed, SUM(if(reports_card.staff_completed_at IS NOT NULL , 1, 0)) AS completed, SUM(if(reports_card.management_flagged_at IS NOT NULL , 1, 0)) AS flagged, SUM(if(reports_card.modified_since_flagged IS NOT NULL , 1, 0)) AS modified_since_flagged, CONCAT(LEFT(staff_users.forename, 1), " ", staff_users.surname) AS staff_name'));
		$query->whereRaw(\DB::raw("staff_classes.class REGEXP '10[a-z].'"));
		$query->where(function($query) {
			$i = 0;
			foreach (\Auth::user()->groups as $group) {
			if ($group->subject_id) {
				if ($i == 0) {
					$query->whereRaw(\DB::raw("staff_classes.class REGEXP './".$group->subject_id."[0-9].?'"));
				} else {
					$query->orWhereRaw(\DB::raw("staff_classes.class REGEXP './".$group->subject_id."[0-9].?'"));
				}
					$i++;
				}

			}
		});
		
		
		$query->groupBy('class');
		return $query->orderBy('class')->get();
	}
	public function allclasses() {
		$i = 0;
		$query = \DB::table($this->table)
							->leftJoin('student_class_list', 'student_class_list.class', '=', 'staff_classes.class')
							->leftjoin('student_users', 'student_class_list.upn', '=', 'student_users.upn')
							->leftJoin('staff_users', 'staff_classes.upn', '=', 'staff_users.upn')
							->leftJoin('reports_card', function($join){
								$join->on('student_users.upn', '=', 'reports_card.student_upn')
									->on('student_class_list.class', '=', 'reports_card.class_id');
							})
							->select(\DB::raw('staff_classes.class AS class, COUNT(DISTINCT student_users.upn) AS student_count, SUM(if(reports_card.management_confirmed_at IS NOT NULL , 1, 0)) AS confirmed, SUM(if(reports_card.staff_completed_at IS NOT NULL , 1, 0)) AS completed, SUM(if(reports_card.management_flagged_at IS NOT NULL , 1, 0)) AS flagged, SUM(if(reports_card.modified_since_flagged IS NOT NULL , 1, 0)) AS modified_since_flagged, CONCAT(LEFT(staff_users.forename, 1), " ", staff_users.surname) AS staff_name'));
		$query->whereRaw(\DB::raw("staff_classes.class REGEXP '10.'"));
		$query->groupBy('class');
		return $query->orderBy('class')->get();
	}
	public function individualclasses($upn) {
		$i = 0;
		$query = \DB::table($this->table)
							->leftJoin('student_class_list', 'student_class_list.class', '=', 'staff_classes.class')
							->leftjoin('student_users', 'student_class_list.upn', '=', 'student_users.upn')
							->leftJoin('staff_users', 'staff_classes.upn', '=', 'staff_users.upn')
							->leftJoin('reports_card', function($join){
								$join->on('student_users.upn', '=', 'reports_card.student_upn')
									->on('student_class_list.class', '=', 'reports_card.class_id');
							})
							->select(\DB::raw('staff_classes.class AS class, COUNT(DISTINCT student_users.upn) AS student_count, SUM(if(reports_card.management_confirmed_at IS NOT NULL , 1, 0)) AS confirmed, SUM(if(reports_card.staff_completed_at IS NOT NULL , 1, 0)) AS completed, SUM(if(reports_card.management_flagged_at IS NOT NULL , 1, 0)) AS flagged, SUM(if(reports_card.modified_since_flagged IS NOT NULL , 1, 0)) AS modified_since_flagged, CONCAT(LEFT(staff_users.forename, 1), " ", staff_users.surname) AS staff_name'));
		$query->where('staff_classes.upn', '=', $upn);
		$query->whereRaw(\DB::raw("staff_classes.class REGEXP '10.'"));
		$query->groupBy('class');
		return $query->orderBy('class')->get();
	}
	
}