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
    return view('welcome', ['name' => 'Art']);
});

//Route::get('weather', 'Weather@show')->middleware('auth');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/feedback', 'FeedbackController@showForm');
Route::get('/feedback2', 'FeedbackController@showForm2');
Route::post('/feedback', 'FeedbackController@saveFeedback');
Route::get('/report', 'FeedbackController@showAll')->middleware('auth');
