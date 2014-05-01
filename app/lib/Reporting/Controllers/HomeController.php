<?php

namespace Reporting\Controllers;

class HomeController extends BaseController {

	protected $user;

	protected $staffClasses;

	protected $reportCardForm;

	protected $reportCard;

	public function __construct(\User $user,\Reporting\Models\StaffClasses $staffClasses, \Reporting\Validation\ReportCardForm $reportCardForm, \Reporting\Models\ReportCard $reportCard)
	{
		/*$this->beforeFilter(function(){
   			if (!\Auth::user()) {
				return \Redirect::to("/")->with('error', 'Please login first.');
			}
   		});	*/
		$this->user = $user;
		$this->staffClasses = $staffClasses; 
		$this->reportCardForm = $reportCardForm;
		$this->reportCard = $reportCard;
	}

	public function getIndex()
	{
		//Hod Permissions, this is specific to creating links not securing the areas.
		$data['hod'] = false;
		if (\Auth::user()->groups) {
			foreach (\Auth::user()->groups as $group) {
				if ($group->subject_id) $data['subjects'][] = $group->subject_id;
				foreach ($group->resources as $resource){
					if ($resource->pattern == 'reportsadmin') $data['hod'] = true;
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
				if($reportCard->management_flagged_at) {
					$reportCard->modified_since_flagged = \Carbon\Carbon::now();
				} else {
					$reportCard->modified_since_flagged = NULL;
				}
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
	public function postFlagcard()
	{
		$card = $this->reportCard;
		$card = $card->find(\Input::get('id'));
		if (count($card) > 0) {
			$card->flagged_comment = \Input::get('flagged_comment');
			$card->management_flagged_at = \Carbon\Carbon::now();
			$card->management_confirmed_at = NULL;
			$card->modified_since_flagged = NULL;
			$card->save();
			return \Response::json(['flash' => 'Report flagged.']);
		}
		return \Response::json(['flash' => 'That report has not yet been completed by the teacher.'], 500);
	}
	public function postCompletecard()
	{
		$card = $this->reportCard;
		$card = $card->find(\Input::get('id'));
		if (count($card) > 0) {
			$card->comment = \Input::get('report_comment');
			$card->management_flagged_at = NULL;
			$card->flagged_comment = NULL;
			$card->modified_since_flagged = NULL;
			$card->management_confirmed_at = \Carbon\Carbon::now();
			$card->save();
			return \Response::json(['flash' => 'Report unflagged and marked as complete.']);
		}
		return \Response::json(['flash' => 'That report has not yet been completed by the teacher.'], 500);
	}

}