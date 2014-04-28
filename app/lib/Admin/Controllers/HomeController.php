<?php

namespace Admin\Controllers;

class HomeController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter(function(){
   			if (!\Auth::user()) {
				return \Redirect::to("/")->with('error', 'Please login first.');
			}
   		});
	}

	public function getIndex()
	{

		return \View::make('Admin::layout.main');
	}

}