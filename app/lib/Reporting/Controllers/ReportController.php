<?php

namespace Reporting\Controllers;

class ReportController extends BaseController {

	protected $user;

	protected $staffClasses;

	protected $group;

	public function __construct(\User $user,\Reporting\Models\StaffClasses $staffClasses, \Group $group)
	{
		/*$this->beforeFilter(function(){
   			if (!\Auth::user()) {
				return \Redirect::to("/")->with('error', 'Please login first.');
			}
   		});	*/
		$this->group = $group;
		$this->user = $user;
		$this->staffClasses = $staffClasses; 
	}

	public function postIndex()
	{
		try {
			$userClasses = $this->staffClasses->classdetails(\Input::get('id'))->get();
			return \Response::json($userClasses);
		} catch (\Exception $e) {
			return \Response::json(['error' => 'Class could not be retrieved ' . $e->getMessage()], 500);
		}
	}
	public function getIndex()
	{
		$data['hod'] = false;
		foreach (\Auth::user()->groups as $group) {
			if ($group->subject_id) $data['subjects'][] = $group->subject_id;
			foreach ($group->resources as $resource){
				if ($resource->pattern == 'reportadmin') $data['hod'] = true;
			}
		}
	}
}