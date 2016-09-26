<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Api\V1\Controllers'], function ($api) {

	$api->post('auth/login', 'AuthController@login');
	$api->post('auth/signup', 'AuthController@signup');
	$api->post('auth/recovery', 'AuthController@recovery');
	$api->post('auth/reset', 'AuthController@reset');

	// example of protected route
	$api->get('protected', ['middleware' => ['api.auth'], function () {		
		return \App\User::all();
    }]);

    // $api->get('me', ['middleware' => 'api.auth', 'UserController@getUser']);

	// example of free route
	$api->get('users', function() {
		return \App\User::all();
	});

	$api->get('courses', function() {
		return \App\Course::all();
	});

	$api->get('circuits', function() {
		return \App\Circuit::all();
	});


	$api->group(['middleware' => 'api.auth'], function ($api) {
	    $api->get('user/profile', 'UserController@getUser');
	    $api->put('user/profile', 'UserController@updateUser');
	    $api->put('user/password', 'UserController@updatePassword');
	    $api->post('user/password', 'UserController@setPassword');
	});
});
