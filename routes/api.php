<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'Api', 'middleware' => 'api'], function () {

	// master
	Route::get('/roles', 'AuthController@roles')->name('user.roles');
	Route::get('/fetchcountry', 'AuthController@fetchCountry');
	Route::get('/fetchEducationType', 'ProfileController@fetchEducationType');
	Route::get('/fetchProjectStatus', 'ProjectController@fetchProjectStatus');
	
	// resgiter 
	Route::post('/checkuserexists', 'AuthController@checkUserExists')->name('user.checkuserexists');
	Route::post('/verifyotp', 'AuthController@verifyotp');
	Route::post('/signup', 'AuthController@postSignup')->name('user.signup');

	// login
	Route::post('/login', 'AuthController@postSignin')->name('user.login');
	Route::post('/loginfirst', 'AuthController@postSignfirst')->name('user.firstlogin');
	
	// profile update
	Route::get('/publicAnonymusUpdate', 'ProfileController@publicAnonymusUpdate');
	Route::post('/updateProfile', 'ProfileController@updateProfile')->name('user.updateProfile');
	Route::post('/uploadProfilePic', 'ProfileController@uploadProfilePic');

	// profile-setting-education
	Route::get('/getalleducation', 'ProfileController@getAllEducation');
	Route::post('/registerEducation', 'ProfileController@registerEducation');
	Route::get('/getEducationById', 'ProfileController@getEducationById');
	Route::post('/updateEducation', 'ProfileController@updateEducation');

	// proejct
	Route::get('/getSearchProject', 'ProjectController@getSearchProject');
	Route::get('/getProjectDeatils', 'ProjectController@getProjectDeatils');
	Route::get('/getAllProject', 'ProjectController@getAllProject');
	Route::post('/createProject', 'ProjectController@createProject');
	Route::get('/getProjectById', 'ProjectController@getProjectById');
	Route::post('/updateProject', 'ProjectController@updateProject');

	Route::middleware('auth:api')->get('/user', function (Request $request) {
	    return $request->user();
	});
});
