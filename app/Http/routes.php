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

//REST Routes
Route::get('event/checkIfUserIsNearEvent/latitude/{latitude}/longitude/{longitude}/distance_area/{distance_area}', 'EventController@checkIfUserIsNearEvent');
Route::post('event/saveUserOnEvent', 'EventController@saveUserOnEvent');
Route::post('event/saveUserChairStatus', 'EventController@saveUserChairStatus');
Route::get('event/{id}/checkIfImportantMomentHasOccured/time_frame/{time_frame}', 'EventController@checkIfImportantMomentHasOccured');
Route::get('event/{id}/getImportantMoments/time_frame/{time_frame}', 'EventController@getImportantMoments');
Route::get('team/{team_id}/getAllTeamEvents/', 'TeamController@getAllTeamEvents');
Route::get('event/getEventsToday', 'EventController@getEventsToday');
Route::get('team/getAllTeams', 'TeamController@getAllTeams');
Route::get('team/{team_id}/getAllTeamMoments', 'TeamController@getAllTeamMoments');
Route::post('user/{user_id}/saveUserTeamFav/teamId/{teamId}', 'UserController@saveUserTeamFav');
Route::get('team/getAllTeamUserMoments/userId/{userId}', 'TeamController@getAllTeamUserMoments');

//REST Resources
Route::resource('user', 'UserController');
Route::resource('event', 'EventController');
Route::resource('moment', 'MomentController');
Route::resource('team', 'TeamController');

Route::auth();

Route::get('/home', 'HomeController@index');
