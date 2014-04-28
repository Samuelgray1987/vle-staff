<?php

namespace Admin\Controllers;

class PermissionsController extends BaseController {

	protected $groupForm;

	public function __construct(\Group $group, \Admin\Validation\GroupForm $groupForm) {
		$this->beforeFilter(function(){
   			if (!\Auth::user()) {
				return \Redirect::to("/")->with('error', 'Please login first.');
			}
   		});	
   		$this->beforeFilter('csrf_json', ['on' => 'post']);
   		$this->groupForm = $groupForm;
		$this->group = $group;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$active = $this->group->orderBy('name')->get()->toArray();
		$inactive = $this->group->orderBy('name')->onlyTrashed()->get()->toArray();
		return \Response::json(['active' => $active, 'inactive' => $inactive]);
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if ($this->groupForm->isPosted()){
			if($this->groupForm->isValidForAdd()){
				$group = new $this->group;
				$group->name = \Input::get('name');
				$group->subject_id = \Input::get('subject_id');
				$group->save();
				return \Response::json(['flash' => 'Your group has been successfully added.']);
			}
			return \Response::json([$this->groupForm->getErrors()->toArray()], 500);
		}
		return \Response::json([$this->groupForm->getErrors()->toArray()], 500);
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
		if($this->groupForm->isDeleted()){
			if($this->groupForm->isValidForDelete()){
				$this->group->findOrFail($id)->delete();
				return \Response::json(['flash' => 'Your group has been successfully deleted']);
			}
			return \Response::json([$this->groupForm->getErrors()->toArray()], 500);
		}
		return \Response::json([$this->groupForm->getErrors()->toArray()], 500);
	}

	public function show($id)
	{
		$group = $this->group->where('id', $id)->get()->toArray();
		if ($group){
			return \Response::json($group);
		} 
		return \Response::json(['flash' => 'no group with that id.']);
	}

}