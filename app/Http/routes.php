<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes - login and registration
Route::auth();

Route::get('/home', 'HomeController@index');


Route::group(['namespace' => "api", 'prefix' => 'api'], function(){
	Route::post('/login', 'AuthController@login');
	Route::post('/register', 'AuthController@register');

	// Login protected route groups
	Route::group([], function(){
		Route::get('/my_profile', 'ProfileController@myprofile');
	});
});