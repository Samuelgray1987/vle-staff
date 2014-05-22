<?php

class StudentDataController extends BaseController {

	protected $studentStartYear;

	public function __construct(StudentStartYear $studentStartYear) 
	{
		$this->studentStartYear = $studentStartYear;
	}

	public function getStudentstartyear()
	{
		return Response::json($this->studentStartYear->orderBy('year', 'DESC')->get());
	}

}