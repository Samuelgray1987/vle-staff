<?php

namespace Reporting\Controllers;

class ReportAdminController extends BaseController {

	protected $user;

	protected $staffClasses;

	protected $group;

	public function __construct(\User $user,\Reporting\Models\StaffClasses $staffClasses, \Group $group)
	{
		$this->group = $group;
		$this->user = $user;
		$this->staffClasses = $staffClasses; 
	}
	public function getIndex()
	{
	}
	public function getAllclasses()
	{
		$classes = $this->staffClasses->hodclasses();
		return \Response::json($this->staffClasses->allclasses());
	}
	public function getHodclasses()
	{
		$classes = $this->staffClasses->hodclasses();
		return \Response::json($this->staffClasses->hodclasses());
	}
}