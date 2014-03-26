<?php
/*
 *
 *Reporting
 *
 */

Route::get('/', "AuthController@getIndex");
Route::controller('/auth', "AuthController");

Route::controller('/reports', "\Reporting\Controllers\HomeController");


/*
 *
 * Admin Area Routing
 *
 */

//BACKEND ROUTING
Route::controller('/admin', "\Admin\Controllers\HomeController");
Route::controller('/permissions', "\Admin\Controllers\UpdatePermissionsController");
Route::resource('/adminuser', "\Admin\Controllers\StaffUserController");
Route::resource('/admingroups', "\Admin\Controllers\PermissionsController");
Route::resource('/adminassignpermissions', "\Admin\Controllers\AssignPermissionsController");

//ANGULAR FRONTEND ROUTING
View::addNamespace('Admin', __DIR__.'/lib/Admin/Views');
Route::get('/users-staff', function(){
	if (!\Auth::user()) {
		return \Redirect::to("/")->with('error', 'Please login first.');
	}
	return View::make('Admin::staff-users.staff-view-all');
});
Route::get('/users-permissions', function(){
	if (!\Auth::user()) {
		return \Redirect::to("/")->with('error', 'Please login first.');
	}
	return View::make('Admin::staff-users.staff-permissions');
});
Route::get('/users-permissions-assign', function(){
	if (!\Auth::user()) {
		return \Redirect::to("/")->with('error', 'Please login first.');
	}
	return View::make('Admin::staff-users.staff-permissions-assign');
});
Route::get('/users-permissions-edit-group', function(){
	if (!\Auth::user()) {
		return \Redirect::to("/")->with('error', 'Please login first.');
	}
	return View::make('Admin::staff-users.staff-permissions-edit-group');
});
