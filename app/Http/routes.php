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

// // Route model bindings
Route::model('user', 'App\User');
// Route::model('profile', 'Profile');
// Authentication routes - login and registration
Route::auth();

Route::get('/home', 'HomeController@index');

// All routes for the API are namespaced in the following group. They will all be of the format /api/<route_name>
Route::group(['namespace' => "api", 'prefix' => 'api', 'middleware' => 'cors'], function(){

  // Routes that don't require the user to be logged in
  Route::post('/login', 'AuthController@login');
	Route::post('/register', 'AuthController@register');

  // Login protected route groups
	Route::group(['middleware' => "auth:api"], function(){
    	Route::get('/profile/:id', 'ProfilesController@myprofile');
        Route::get('test', 'ExperiencesController@test');
        Route::get('/exp_types','ExperiencesController@exp_types');

        //
        Route::get('/recommend_skill/{skill_id}/{user_id}', 'SkillsController@recommend_skill');
        Route::get('/derecommend_skill/{skill_id}/{user_id}', 'SkillsController@derecommend_skill');

        // join and unjoin groups
        Route::get('/join_group/{group_id}', 'GroupsController@join_group');
        Route::get('/unjoin_group/{group_id}', 'GroupsController@unjoin_group');

        // get experiences, freelance, or training entries
        Route::get('/get_experience', 'ExperiencesController@get_experience');
        Route::get('/get_freelance', 'ExperiencesController@get_freelance');
        Route::get('/get_training', 'ExperiencesController@get_training');

        // Restful routes
        Route::resource('/works', 'WorksController');
        Route::resource('/profiles', 'ProfilesController');
        Route::resource('/fas', 'FasController');
        Route::resource('experiences','ExperiencesController');
        Route::resource('/skills','SkillsController');
        Route::resource('/groups','GroupsController');

        // Nested resource routes
        Route::resource('user.experiences','UsersExperiencesController', ['only' => ['index', 'destroy', 'store']] );
        Route::resource('user.fas','UsersFasController', ['only' => ['index', 'store']] );
        Route::resource('user.profiles','UsersProfilesController', ['only' => ['index']] );
        Route::resource('user.works','UsersWorksController', ['only' => ['index', 'store']] );

	}); // end of logged in requirement group
}); // end of API namespaced routes

// Route for the users unique url. For example: joinluli.com/user_name. Leave this in the end because it can intefere with other routes.
Route::get("/{username}", 'ProfilesController@public_profile');
