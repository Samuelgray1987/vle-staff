<?php

namespace Admin\Controllers;

class StaffUserController extends BaseController {

	protected $user;

	protected $group;

	public function __construct(\Group $group, \User $user) {
		$this->beforeFilter(function(){
   			if (!\Auth::user()) {
				return \Redirect::to("/")->with('error', 'Please login first.');
			}
   		});	
		$this->user = $user;
		$this->group = $group;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Old code, too slow, replaced with \Admin\Controllers\HomeController
		/*$active = $this->user->orderBy('surname')->get()->toArray();
		$inactive = $this->user->orderBy('surname')->onlyTrashed()->get()->toArray();
		foreach ($active as &$staff){
			$users = $this->group->find(\Input::get('group'))->users()->where('user_id', $staff['username'])->get();
			if (count($users) == 0) {
				$staff['checked'] = false;
			} else {	
				$staff['checked'] = true;
			}
		}
		return \Response::json(['active' => $active, 'inactive' => $inactive]);*/
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		try {
			$user = $this->user->where('upn', $id)->first(); 
			if (!$user) throw new \Exception("The id you specified was not found in the database, please try again with a different user.");
			return \Response::json($user);
		} catch (\Exception $e) {
			return \Response::json(['flash' => $e->getMessage()], 500);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try {
			$user = $this->user->where('id', $id)->first(); 
			if (!$user) throw new \Exception("The id you specified was not found in the database, please try again with a different user.");
			return \Response::json($user);
		} catch (\Exception $e) {
			return \Response::json(['flash' => $e->getMessage()], 500);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}