<?php

namespace Reporting\Models;

class ReportsPrinting extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reports_printing';

	public function printingOverview($yeargroup) {
		return \DB::table($this->table)
				 ->join('student_users', 'reports_printing.upn', '=', 'student_users.upn')
				 ->select(\DB::raw('SUM( if( errors IS NOT NULL , 1, 0 ) ) AS number_errors'),
				 		  \DB::raw('COUNT( class_code ) AS number_subjects'),
				 		  'reports_printing.upn',
				 		  'reports_printing.reg_group',
				 		  'student_users.forename',
				 		  'student_users.surname')
				 ->where('yeargroup', $yeargroup)
				 ->groupBy('upn')
				 ->orderBy('reg_group', 'desc')
				 ->get();
	}
}