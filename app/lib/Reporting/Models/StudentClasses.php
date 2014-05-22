<?php

namespace Reporting\Models;

class StudentClasses extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'student_class_list';

	public function studentsByYeargroup($yeargroup) {
		$query = \DB::table($this->table)
							->join('student_users', 'student_class_list.upn', '=', 'student_users.upn')
							->select(\DB::raw('student_users.upn AS upn, student_users.forename AS forename, student_users.surname AS surname'));
		$query->whereRaw(\DB::raw("student_class_list.class REGEXP '".$yeargroup.".'"));
		$query->groupBy('student_class_list.upn');
		return $query->orderBy('student_users.surname')->get();
	}
	public function individualclasses($upn, $yeargroup) {
		$query = \DB::table($this->table)
							->join('staff_classes', 'student_class_list.class', '=', 'staff_classes.class')
							->join('staff_users', 'staff_classes.upn', '=', 'staff_users.upn')
							->select(\DB::raw('staff_classes.class AS class, staff_users.forename AS staff_forename, staff_users.surname AS staff_surname'));
		$query->where('student_class_list.upn', '=', $upn);
		$query->whereRaw(\DB::raw("staff_classes.class REGEXP '^".$yeargroup.".'"));
		return $query->orderBy('class')->get();
	}
}