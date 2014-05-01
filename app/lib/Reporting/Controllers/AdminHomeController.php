<?php

namespace Reporting\Controllers;

class AdminHomeController extends BaseController {

	protected $user;

	protected $staffClasses;

	protected $reportCardForm;

	protected $reportCard;

	public function __construct(\User $user,\Reporting\Models\StaffClasses $staffClasses, \Reporting\Validation\ReportCardForm $reportCardForm, \Reporting\Models\ReportCard $reportCard)
	{
		$this->user = $user;
		$this->staffClasses = $staffClasses; 
		$this->reportCardForm = $reportCardForm;
		$this->reportCard = $reportCard;
	}

	public function getIndex()
	{
		//Hod Permissions, this is specific to creating links not securing the areas.
		$data['hod'] = 0;
		$data['admin'] = 0;
		if (\Auth::user()->groups) {
			foreach (\Auth::user()->groups as $group) {
				if ($group->subject_id != NULL) {
					$data['subjects'][] = $group->subject_id;
					$data['hod'] = 1;
				}
				foreach ($group->resources as $resource){
					if ($resource->pattern == 'reportsadmin') $data['admin'] = 1;
				}
			}
		}
		return \View::make('Reporting::layout.main')->with('data', $data);
	}

	public function postInsertcard()
	{
		if ($this->reportCardForm->isPosted()){
			if($this->reportCardForm->isValidForAdd()){
				$reportCard = $this->reportCard->where('class_id', \Input::get('class_id'))->where('student_upn', \Input::get('student_upn'))->first();
				if (count($reportCard) == 0) $reportCard = new $this->reportCard;
				$reportCard->comment = \Input::get('report_comment');
				$reportCard->student_upn = \Input::get('student_upn');
				$reportCard->staff_upn = \Input::get('staff_upn');
				$reportCard->class_id = \Input::get('class_id');
				$reportCard->staff_completed_at = \Carbon\Carbon::now();
				$reportCard->created_at = \Carbon\Carbon::now();
				$reportCard->updated_at =  \Carbon\Carbon::now();
				$reportCard->save();
				return \Response::json(['id' => $reportCard->id]);
			}
			return \Response::json([$this->reportCardForm->getErrors()->toArray()], 500);
		}
		return \Response::json([$this->reportCardForm->getErrors()->toArray()], 500);
	}

	public function postDeletecard()
	{
		$card = $this->reportCard;
		$card = $card->find(\Input::get('id'));
		if (count($card) > 0) {
			$card->forceDelete();
			return \Response::json(['flash' => 'Report deleted.']);
		}
		return \Response::json(['flash' => 'Card does not exist.'], 500);
	}

}