<?php

class StaffClassesController extends BaseController {

	protected $user;

	protected $staffClasses;

	protected $reportStaffClasses;

	public function __construct(\User $user,\StaffClasses $staffClasses, \Reporting\Models\StaffClasses $reportStaffClasses)
	{
		$this->user = $user;
		$this->staffClasses = $staffClasses; 
		$this->reportStaffClasses = $reportStaffClasses;
	}

	/**
	 * The index accepts an ID which will return a classes students /staff/class?id=10A/Ad1
	 *
	 * @return Response
	 */
	public function index()
	{
		try {
			$userClasses = $this->staffClasses->classdetails(Input::get('id'))->get();
			return Response::json($userClasses);
		} catch (\Exception $e) {
			return Response::json(['error' => 'Class could not be retrieved ' . $e->getMessage()], 500);
		}
	}
	public function show($id)
	{
		if ($id == "upn") {
			$id = "ETN";
			//$id = Auth::user()->upn;
		}
		$userClasses = $this->reportStaffClasses->individualclasses($id);
		if ($userClasses) return Response::json($userClasses);
		return Response::json(['error' => 'No class data'], 500);
	}

}