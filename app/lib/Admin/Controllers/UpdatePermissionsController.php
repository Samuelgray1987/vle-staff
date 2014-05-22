<?php

namespace Admin\Controllers;

class UpdatePermissionsController extends BaseController {

	protected $groupForm;

	protected $group;

	protected $user;

	protected $resource;

	protected $groupResource;

	protected $groupuser;

	public function __construct(\Group $group, \Admin\Validation\GroupForm $groupForm, \User $user, \Resource $resource, \GroupResource $groupResource, \GroupUser $groupUser) {
		$this->beforeFilter(function(){
   			if (!\Auth::user()) {
				return \Redirect::to("/")->with('error', 'Please login first.');
			}
   		});	
   		$this->groupForm = $groupForm;
		$this->group = $group;
		$this->user = $user;
		$this->resource = $resource;
		$this->groupResource = $groupResource;
		$this->groupUser = $groupUser;
	}
	public function postUser(){
		if(\Input::get('group') && \Input::get('user')){
			try {
				$users = $this->group->find(\Input::get('group'))->users()->where('user_id', \Input::get('user'))->get();
			} catch (\Exception $e) {
				return \Response::json(false);
			}

			if(count($users) > 0)
			{
				return \Response::json(true);
			} 
		}
		return \Response::json(false);
	}

	public function postUserupdate(){
		if(\Input::get('group') && \Input::get('user')){
			try {
				$users = $this->group->find(\Input::get('group'))->users()->where('user_id', \Input::get('user'))->get();
			} catch (\Exception $e) {
				$error[] = $e->getMessage();
			}

			if(count($users) == 0)
			{
				$groupUser = $this->groupUser;
				$groupUser->group_id = \Input::get('group');
				$groupUser->user_id = \Input::get('user');
				$groupUser->save();
				return \Response::json(['flash' => 'New permission added']);
			} else {
				try {
					$groupUser = $this->groupUser->where('group_id', \Input::get('group'))->where('user_id', \Input::get('user'))->first();
					$groupUser->forceDelete();
				} catch (\Exception $e) {
					return \Response::json(['flash' => $e->getMessage()], 500);
				}
				return \Response::json(['flash' => 'Permission removed']);
			}
			return \Response::json(['flash' => 'Error'], 500);
		}
		return \Response::json(false);
	}

	public function postGroupusers()
	{
		if(\Input::get('group') && \Input::get('resource')){
			try {
				$resource = $this->resource->find(\Input::get('resource'))->groups()->where('group_id', '=', \Input::get('group'))->get();
			} catch (\Exception $e) {
				return \Response::json(false);
			}

			if(count($resource) > 0)
			{
				return \Response::json(true);
			} 
		}
		return \Response::json(false);
	}
	public function postGroupupdate()
	{
		if(\Input::get('group') && \Input::get('resource')){
			try {
				$resource = $this->resource->find(\Input::get('resource'))->groups()->where('group_id', '=', \Input::get('group'))->get();
			} catch (\Exception $e) {
				$error[] = $e->getMessage();
			}

			if(count($resource) == 0)
			{
				$groupResource = $this->groupResource;
				$groupResource->group_id = \Input::get('group');
				$groupResource->resource_id = \Input::get('resource');
				$groupResource->save();
				return \Response::json(['flash' => 'New permission added']);
			} else {
				try {
					$groupResource = $this->groupResource->where('resource_id', \Input::get('resource'))->where('group_id', \Input::get('group'))->first();
					$groupResource->forceDelete();
				} catch (\Exception $e) {
					return \Response::json(['flash' => $e->getMessage()], 500);
				}
				return \Response::json(['flash' => 'Permission removed']);
			}
			return \Response::json(['flash' => 'Error'], 500);
		}
		return \Response::json(false);
	}
	

}