<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/feedback', 'FeedbackController@showForm');
Route::get('/feedback2', 'FeedbackController@showForm2');
Route::post('/feedback', 'FeedbackController@saveFeedback');
Route::get('/report', 'FeedbackController@showAll')->middleware('auth');
