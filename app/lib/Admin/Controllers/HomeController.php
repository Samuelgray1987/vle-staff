<?php

namespace Admin\Controllers;

class HomeController extends BaseController {

	protected $user;

	protected $group;

	public function __construct(\Group $group, \User $user)
	{
		$this->beforeFilter(function(){
   			if (!\Auth::user()) {
				return \Redirect::to("/")->with('error', 'Please login first.');
			}
   		});
   		$this->group = $group;
   		$this->user = $user;
	}

	public function getIndex()
	{

		return \View::make('Admin::layout.main');
	}
	public function getPermissionsstaff($id)
	{
		//Get the users to display on the users permissions edit group
		$active = $this->user->orderBy('surname')->get()->toArray();
		$inactive = $this->user->orderBy('surname')->onlyTrashed()->get()->toArray();
		foreach ($active as &$staff){
			$users = $this->group->find($id)->users()->where('user_id', $staff['username'])->get();
			if (count($users) == 0) {
				$staff['checked'] = false;
			} else {	
				$staff['checked'] = true;
			}
		}
		return \Response::json(['active' => $active, 'inactive' => $inactive]);
	}

}