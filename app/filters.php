<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/
App::missing(function($exception)
{
    return Response::view('errors.missing', array('url' => Request::url()), 404);
});
App::error(function($exception, $code){
    return Response::view('errors.programmingerror', array('url' => Request::url(), 'error' => $exception), $code);
});

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/
Route::filter('stdauth', function()
{
    if (Auth::guest()) {
        return Redirect::guest('/');
    } 
    return;
});

Route::filter('auth', function()
{
	if (Auth::guest()) {
		return Redirect::guest('/');
	} else {
		foreach (Auth::user()->groups as $group)
        {
            foreach ($group->resources as $resource)
            {
                $path = Route::getCurrentRoute()->getPath();
                if ($resource->pattern == $path)
                {
                    return;
                }
            }
        }
        return Redirect::to("/")->with('error', 'You do not have permission to access this area.'); 
	}
});
Route::filter('ctrlauth', function()
{
	if (Auth::guest()) {
		return Redirect::guest('/');
	} else {
		foreach (Auth::user()->groups as $group)
        {
            foreach ($group->resources as $resource)
            {
                $segment = Request::segment(1);
                $path = Route::getCurrentRoute()->getPath();
                if ($resource->pattern == $segment || $resource->pattern == $path)
                {
                    return;
                }
            }
        }
        return Redirect::to("/")->with('error', 'You do not have permission to access this area.'); 
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/
Route::filter('csrf_json', function() {
	if (Session::token() != Input::json('CSRF_TOKEN')) {
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});