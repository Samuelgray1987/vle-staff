<?php
/*
 *****************
 * Common Routes *
 *****************
 */
	//Unsecure
	Route::get('/', "AuthController@getIndex");
	Route::controller('/auth', "AuthController");
	//Secure
	Route::group(array('before' => 'stdauth'), function(){
		Route::resource('/staff/class', "StaffClassesController");
		Route::controller('/attainment', "AttainmentController");
	});

/*
 **********************
 * Admin Area Routing *
 **********************
 */
	Route::group(array('before' => 'ctrlauth'), function() {
		//Secure routes

		//BACKEND ROUTING
		Route::controller('/admin', "\Admin\Controllers\HomeController");
		Route::controller('/permissions', "\Admin\Controllers\UpdatePermissionsController");
		Route::resource('/adminuser', "\Admin\Controllers\StaffUserController");
		Route::resource('/admingroups', "\Admin\Controllers\PermissionsController");
		Route::resource('/adminassignpermissions', "\Admin\Controllers\AssignPermissionsController");
		Route::resource('/adminresources', "\Admin\Controllers\ResourcesController");

		//ANGULAR FRONTEND ROUTING
		View::addNamespace('Admin', __DIR__.'/lib/Admin/Views');
		Route::get('/users-staff', function(){
			return View::make('Admin::staff-users.staff-view-all');
		});
		Route::get('/users-permissions', function(){
			return View::make('Admin::staff-users.staff-permissions');
		});
		Route::get('/users-permissions-edit-group', function(){
			return View::make('Admin::staff-users.staff-permissions-edit-group');
		});
	});


/*
 ************************
 * Reports Area Routing *
 ************************
 */
	Route::group(array('before' => 'stdauth'), function(){
		//Load Template View
		Route::controller('/reports', "\Reporting\Controllers\HomeController");

		//BACKEND ROUTING
		Route::controller('/report/classes', "\Reporting\Controllers\ReportController");
		Route::controller('/report/admin', "\Reporting\Controllers\ReportAdminController");

		//ANGULAR FRONTEND ROUTING
		View::addNamespace('Reporting', __DIR__.'/lib/Reporting/Views');
		Route::get('/views/reports/reportcard/dashboard', function(){
			return View::make('Reporting::reportcards.dashboard');
		});
		Route::get('/views/reports/reportcard/edit-report-cards', function(){
			return View::make('Reporting::reportcards.edit-report-cards');
		});
	});
	
	/**************
	 ** HOD AREA **
	 **************
	*/
	Route::group(array('before' => 'stdauth'), function(){
		//Secure template view
		Route::controller('/reportsadmin', "\Reporting\Controllers\AdminHomeController");
		//ANGULAR FRONTEND ROUTING
		Route::get('/views/reportsadmin/reportcard/dashboard', function(){
			return View::make('Reporting::admin.admin-dashboard');
		});
		Route::get('/views/reportsadmin/reportcard/edit-report-cards', function(){
			return View::make('Reporting::admin.admin-edit-report-cards');
		});
	});