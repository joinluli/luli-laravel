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

// general web namespace
Route::get('/home', 'HomeController@index');
Route::post('register', 'Auth\AuthController@register');

Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('/callback/{provider}', 'SocialAuthController@callback');

// Login protected routes
Route::group(['middleware' => 'auth'], function(){

    // routes for profiles
    Route::get('create_profile_1', 'ProfilesController@create_1');
    Route::get('create_profile_2', 'ProfilesController@create_2');
    Route::get('create_profile_3', 'ProfilesController@create_3');
    Route::get('create_profile_4', 'ProfilesController@create_4');
    Route::get('create_profile_5', 'ProfilesController@create_5');
    Route::get('create_social', 'ProfilesController@create_social');
    // Post routes
    Route::post('create_profile_1', 'ProfilesController@store_1');
    Route::post('create_profile_2', 'ProfilesController@store_2');
    Route::post('create_profile_3', 'ProfilesController@store_3');
    Route::post('create_profile_4', 'ProfilesController@store_4');
    Route::post('create_profile_5', 'ProfilesController@store_5');
    Route::post('create_social', 'ProfilesController@store_social');

    // Route for my profile
    Route::get('my_profile', 'ProfilesController@my_profile');

    // Resource routes
    Route::resource('skills', 'SkillsController', ['only' => ['index', 'store', 'update','destroy']]);
    Route::resource('educations', 'EducationsController', ['only' => ['index', 'store', 'update','destroy']]);

});



/**
 * API ROUTES BELOW. DO NOT MODIFY ANYTHING IF YOU ARE ATTEMPTING TO CHANGE THE WEB ROUTES.
 */

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
        Route::get('/user/{user_id}/like_job_post/{job_application_id}', 'UsersJobFavoritesController@heart_dat');

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
        Route::resource('job_postings', 'JobPostingsController', ['only' => ['show', 'index']]);
        Route::resource('job_applications', 'JobApplicationsController');

        // Nested resource routes
        Route::resource('user.experiences','UsersExperiencesController', ['only' => ['index', 'destroy', 'store']] );
        Route::resource('user.skills', 'UsersSkillsController', ['only' => ['index']]);
        Route::resource('user.fas','UsersFasController', ['only' => ['index', 'store']] );
        Route::resource('user.profiles','UsersProfilesController', ['only' => ['index']] );
        Route::resource('user.works','UsersWorksController', ['only' => ['index', 'store']] );
        Route::resource('user.job_postings', 'UsersJobPostingsController', ['only' => ['index', 'store', 'destroy', 'update']]);
        Route::resource('user.job_applications', 'UsersJobApplicationsController', ['only' => ['index']]);

        // search testing
        Route::get('search/{search_terms}', 'JobPostingsController@search');

	}); // end of logged in requirement group
}); // end of API namespaced routes

// Route for the users unique url. For example: joinluli.com/user_name. Leave this in the end because it can intefere with other routes.
Route::get("/{username}", 'ProfilesController@public_profile');
