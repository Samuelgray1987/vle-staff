<?php

namespace Reporting\Controllers;

class PrintController extends BaseController {

	protected $user;

	protected $studentClasses;

	protected $reportCardForm;

	protected $reportCard;

	protected $staffClasses;

	protected $subjects;

	protected $reportsPrinting;

	public $yeargroup;

	public $attainment_date;

	public function __construct(\Reporting\Models\ReportsPrinting $reportsPrinting, \Attainment $attainment, \Subjects $subjects, \Reporting\Models\StaffClasses $staffClasses, \User $user,\Reporting\Models\StudentClasses $studentClasses, \Reporting\Validation\ReportCardForm $reportCardForm, \Reporting\Models\ReportCard $reportCard)
	{
		$this->user = $user;
		$this->studentClasses = $studentClasses; 
		$this->reportCardForm = $reportCardForm;
		$this->reportCard = $reportCard;
		$this->staffClasses = $staffClasses;
		$this->subjects = $subjects;
		$this->attainment = $attainment;
		$this->reportsPrinting = $reportsPrinting;
	}

	public function getIndex()
	{
		//Retrieve all students for a given yeargroup
		//Retrieve all classes for the given student
		$x = 0;
		$printData = [];
		$errors[$x] = [];
		$this->yeargroup = \Input::get('yeargroup');
		$this->attainment_date = \Input::get('attainment_date');

		if($this->yeargroup != "" && $this->attainment != "") {
			$students = $this->studentClasses->studentsByYeargroup($this->yeargroup);
			foreach ( $students as &$student ) {

				//Basic Student Data
				$printData[$x]['student_upn'] = $student->upn;
				$printData[$x]['student_forename'] = $student->forename;
				$printData[$x]['student_surname'] = $student->surname;
				$printData[$x]['student_yeargroup'] = $this->yeargroup;
				$printData[$x]['year_of_study'] = "2013/14";

				//Classes & Reg group the student takes
				$classes = $this->studentClasses->individualclasses($student->upn, $this->yeargroup);

				$codes = \App::make('retrieveClassCode', $classes);

				//Loop through each class
				if (count($codes) > 0) {

					foreach ($codes as $k => $v) {
						if(isset($v['reg'])) {
							//Set data manually for registration group
							$printData[$x]['student_reg'] = $v['reg'];
							$printData[$x]['student_subjects']["reg_group"]['subject_info'] = $this->staffClasses
											->join('staff_users', 'staff_users.upn', '=', 'staff_classes.upn')
											->where('staff_classes.class' ,'=', $v['reg'])
											->select(\DB::raw('LEFT(staff_users.forename, 1) as staff_forename'), 
													 'staff_users.surname as staff_surname')
											->groupBy('staff_users.upn')
											->get()
											->toArray();
							$printData[$x]['student_subjects']["reg_group"]['subject_details'][0]['name'] = "Registration Group";
							$printData[$x]['student_subjects']["reg_group"]['subject_details'][0]['qualification'] = "N/A";
							$printData[$x]['student_subjects']["reg_group"]['subject_details'][0]['overview'] = "Student registration group";
							$printData[$x]['student_subjects']["reg_group"]['class_code'] = $v['reg']; 
							$printData[$x]['student_subjects']["reg_group"]['student_report'] = $this->reportCard
								->join('staff_classes', 'staff_classes.class', '=', 'reports_card.class_id')
								->join('staff_users', 'staff_users.upn', '=', 'staff_classes.upn')
								->leftJoin('attainment', function($join) use ($v) {
									$join->on('attainment.upn', '=', 'reports_card.student_upn')
									->where('attainment.subject', '=', "reg_group_fake");
								})
								->select('comment', 'staff_completed_at', 
										 'management_confirmed_at', 
										 'management_flagged_at', 
										 'attainment.target as target',
										 'attainment.predicted as predicted',
										 'attainment.current as current'
										 )
								->where('student_upn', '=', $student->upn)
								->where('class_id', '=', $v['reg'])
								->get()
								->toArray();
							$printData[$x]['student_subjects']["reg_group"]['class_code'] = "reg_group"; 
						} else {
							//More automation for non-reg groups
							if(isset($v[0]) && isset($v['class_code'])) {
								$printData[$x]['student_subjects'][$v[0]]['subject_details'] = $this->subjects->where('code', '=', $v[0])->get()->toArray();
								$printData[$x]['student_subjects'][$v[0]]['student_report'] = $this->reportCard
											->leftJoin('staff_classes', 'staff_classes.class', '=', 'reports_card.class_id')
											->leftJoin('staff_users', 'staff_users.upn', '=', 'staff_classes.upn')
											->leftJoin('attainment', function($join) use ($v) {
												$join->on('attainment.upn', '=', 'reports_card.student_upn')
												->where('attainment.subject', '=', $v[0]);
											})
											->select('comment', 'staff_completed_at', 
													 'management_confirmed_at', 
													 'management_flagged_at', 
													 'attainment.target as target',
													 'attainment.predicted as predicted',
													 'attainment.current as current')
											->where('student_upn', '=', $student->upn)
											->where('class_id', '=', $v['class_code'])
											->where('date', '=', $this->attainment_date)
											->get()
											->toArray();
								$printData[$x]['student_subjects'][$v[0]]['subject_info'] = $this->staffClasses
											->join('staff_users', 'staff_users.upn', '=', 'staff_classes.upn')
											->where('staff_classes.class' ,'=', $v['class_code'])
											->select(\DB::raw('LEFT(staff_users.forename, 1) as staff_forename'), 
													 'staff_users.surname as staff_surname')
											->groupBy('staff_users.upn')
											->get()
											->toArray();
								$results = $this->attainment->where('upn', $student->upn)->where('subject', $v[0])->get()->toArray();
								if (count($printData[$x]['student_subjects'][$v[0]]['student_report']) == 0 && count($printData[$x]['student_subjects'][$v[0]]['subject_details']) > 0) {
									$errors[$x]['reports'][$v['class_code']] = "Report missing";
								}
								$printData[$x]['student_subjects'][$v[0]]['class_code'] = $v['class_code']; 
							}
						}
						
					}//End of class code
				}
				$this->addToDatabase($printData[$x]);
				$x++;
			}//End of Student
		} else {
			return \Response::json(['flash' => 'Error yeargroup or attainment data missing'], 500);
		}
		
	}
	public function addToDatabase($data) {
		if (isset($data['student_subjects'])) {
			echo "<pre>";
			var_dump($data);
			foreach ($data['student_subjects'] as $ss) {
				$checkForErrors = true;
				$print = $this->reportsPrinting->where('upn', $data['student_upn'])->where('class_code', $ss['class_code'])->first();
				if (count($print) == 0)	$print = new $this->reportsPrinting;
				$errors = "";
				if (isset($ss['student_report'][0]['management_confirmed_at'])) {
					if ($ss['student_report'][0]['management_confirmed_at'] != NULL) {
						$checkForErrors = false;
					}
				}	
				if ($checkForErrors == true) {
					//Setting data and catching missing data.
					if (isset($data['student_upn'])) {$upn = $data['student_upn'];} else {$upn = ""; $errors .= 'Student UPN Missing;';}
					if (isset($data['student_yeargroup'])) {$yeargroup = $data['student_yeargroup'];} else {$yeargroup = ""; $errors .= 'Yeargroup missing;';}
					if (isset($data['year_of_study'])) {$year = $data['year_of_study'];} else {$year = ""; $errors .= 'Year of study missing;';}
					if (isset($data['student_reg'])) {$reg_group = $data['student_reg'];} else {$reg_group = ""; $errors .= 'Registration group missing;';}
					if (isset($ss['class_code'])) {$class_code = $ss['class_code'];} else {$class_code = ""; $errors .= 'Class code missing;';}
					if (isset($ss['student_report'][0]['target'])) {$target = $ss['student_report'][0]['target'];} else {$target = ""; $errors .= 'Target missing;';}
					if (isset($ss['student_report'][0]['predicted'])) {$predicted = $ss['student_report'][0]['predicted'];} else {$predicted = ""; $errors .= 'Predicted grade missing;';}
					if (isset($ss['student_report'][0]['comment'])) {$comment = $ss['student_report'][0]['comment'];} else {$comment = ""; $errors .= 'Report comment missing;';}
					if (isset($ss['subject_details'][0]['name'])) {$subject_name = $ss['subject_details'][0]['name'];} else {$subject_name = ""; $errors .= 'Subject name missing;';}
					if (isset($ss['subject_details'][0]['qualification'])) { if ($ss['subject_details'][0]['qualification'] != "") { $subject_qualification = $ss['subject_details'][0]['qualification'];} else {$subject_qualification = ""; $errors .= 'Subject qualification missing;';} } else {$subject_qualification = ""; $errors .= 'Subject qualification missing;';}
					if (isset($ss['subject_details'][0]['overview'])) { if ($ss['subject_details'][0]['overview'] != "") { $subject_overview = $ss['subject_details'][0]['overview']; } else {$subject_overview = ""; $errors .= 'Subject overview missing;';} } else {$subject_overview = ""; $errors .= 'Subject overview missing;';}
					if (isset($ss['subject_details'][0]['hod'])) { if ($ss['subject_details'][0]['hod'] != "") { $subject_hod = $ss['subject_details'][0]['hod']; } else {$subject_hod = ""; $errors .= 'Subject hod missing;';} } else {$subject_hod = ""; $errors .= 'Subject hod missing;';}
				} else {
					if (isset($data['student_upn'])) {$upn = $data['student_upn'];} else {$upn = ""; }
					if (isset($data['student_yeargroup'])) {$yeargroup = $data['student_yeargroup'];} else {$yeargroup = ""; }
					if (isset($data['year_of_study'])) {$year = $data['year_of_study'];} else {$year = ""; }
					if (isset($data['student_reg'])) {$reg_group = $data['student_reg'];} else {$reg_group = ""; }
					if (isset($ss['class_code'])) {$class_code = $ss['class_code'];} else {$class_code = "";}
					if (isset($ss['student_report'][0]['target'])) {$target = $ss['student_report'][0]['target'];} else {$target = ""; }
					if (isset($ss['student_report'][0]['predicted'])) {$predicted = $ss['student_report'][0]['predicted'];} else {$predicted = ""; }
					if (isset($ss['student_report'][0]['comment'])) {$comment = $ss['student_report'][0]['comment'];} else {$comment = ""; }
					if (isset($ss['subject_details'][0]['name'])) {$subject_name = $ss['subject_details'][0]['name'];} else {$subject_name = ""; }
					if (isset($ss['subject_details'][0]['qualification'])) { if ($ss['subject_details'][0]['qualification'] != "") { $subject_qualification = $ss['subject_details'][0]['qualification'];} else {$subject_qualification = ""; } } else {$subject_qualification = ""; }
					if (isset($ss['subject_details'][0]['overview'])) { if ($ss['subject_details'][0]['overview'] != "") { $subject_overview = $ss['subject_details'][0]['overview']; } else {$subject_overview = ""; } } else {$subject_overview = ""; }
					if (isset($ss['subject_details'][0]['hod'])) { if ($ss['subject_details'][0]['hod'] != "") { $subject_hod = $ss['subject_details'][0]['hod']; } else {$subject_hod = "";} } else {$subject_hod = ""; }
				}
				//Save data
				$print->upn = $upn;
				$print->yeargroup = $yeargroup;
				$print->year = $year;
				$print->reg_group = $reg_group;
				$print->class_code = $class_code;
				$print->target = $target;
				$print->predicted = $predicted;
				$print->comment = $comment;
				$print->subject_name = $subject_name;
				$print->subject_qualification = $subject_qualification;
				$print->subject_overview = $subject_overview;
				$print->subject_hod = $subject_hod;
				$print->errors = $errors;
				$print->created_at = \Carbon\Carbon::now();
				$print->updated_at = \Carbon\Carbon::now();
				$print->save(); 
			}
		}
	}
	public function getPrintoverview()
	{
		return \Response::json(['data' => $this->reportsPrinting->printingOverview(\Input::get('yeargroup'))]);
	}
	public function getPrintview()
	{
		$data = $this->reportsPrinting->join('student_users', 'student_users.upn', '=', 'reports_printing.upn')
									  ->select('reports_printing.yeargroup AS yeargroup', 'reg_group', 'class_code', 'target', 'predicted', 'comment', 'subject_name', 'subject_qualification', 'subject_overview', 'student_users.forename AS forename', 'student_users.surname AS surname', 'reports_printing.upn AS upn')
									  ->where('yeargroup', \Input::get('yeargroup'))
									  ->orderBy('reg_group', 'ASC')
									  ->orderBy('subject_name', 'ASC')
									  ->orderBy('upn', 'DESC')
									  ->get();
		return \View::make('Reporting::print.pdf')->with('data', $data);
	}
	public function getPrintattainmentoptions()
	{
		return \Response::json(['data' => $this->attainment->select('date')->where('student_start_year', \Input::get('startyear'))->groupBy('student_start_year')->get()->toArray()]);
	}
	public function getStudenterrors() 
	{
		return \Response::json(['data' => $this->reportsPrinting->where('upn', \Input::get('upn'))->orderBy('subject_name', 'ASC')->get()->toArray()]);
	}
}