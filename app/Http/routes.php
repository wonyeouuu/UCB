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
Route::auth();
Route::get('/checkLogin', function() {
    if (Auth::check()) {
        return 1;
    } else {
        return 0;
    }
});

Route::get('/reminder', 'ReminderController@all');
Route::post('/reminder/create', 'ReminderController@create');
