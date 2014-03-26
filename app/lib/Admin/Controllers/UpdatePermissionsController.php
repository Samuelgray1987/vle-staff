<?php

namespace Admin\Controllers;

class UpdatePermissionsController extends \BaseController {

	protected $groupForm;

	protected $group;

	protected $user;

	protected $resource;

	public function __construct(\Group $group, \Admin\Validation\GroupForm $groupForm, \User $user, \Resource $resource) {
		$this->beforeFilter(function(){
   			if (!\Auth::user()) {
				return \Redirect::to("/")->with('error', 'Please login first.');
			}
   		});	
   		$this->beforeFilter('csrf_json', ['on' => 'post']);
   		$this->groupForm = $groupForm;
		$this->group = $group;
		$this->user = $user;
		$this->resource = $resource;
	}
	public function getGroup(){
		
	}
	public function postGroupusers()
	{
		if(\Input::get('username') && \Input::get('group')) {
			$groups = $this->group->find(\Input::get('group'))->users()->where('user_id', '=', \Input::get('username'))->get();
			return \Response::json($groups);
		} 
		return \Response::json(['flash' => 'User is not part of this group']);
	}
	

}