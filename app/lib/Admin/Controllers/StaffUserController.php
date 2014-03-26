<?php

namespace Admin\Controllers;

class StaffUserController extends BaseController {

	protected $user;

	public function __construct(\User $user) {
		$this->beforeFilter(function(){
   			if (!\Auth::user()) {
				return \Redirect::to("/")->with('error', 'Please login first.');
			}
   		});	
		$this->user = $user;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$active = $this->user->orderBy('surname')->get()->toArray();
		$inactive = $this->user->orderBy('surname')->onlyTrashed()->get()->toArray();
		return \Response::json(['active' => $active, 'inactive' => $inactive]);
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