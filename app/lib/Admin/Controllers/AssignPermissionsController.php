<?php

namespace Admin\Controllers;

class AssignPermissionsController extends \BaseController {

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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = $this->user->orderBy('surname')->get()->toArray();
		$resources = $this->resource->where('secure', true)->get()->toArray();
		$groups = $this->group->orderBy('name')->get()->toArray();
		return \Response::json(['users' => $user, 'resources' => $resources, 'groups' => $groups]);
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
	}

}