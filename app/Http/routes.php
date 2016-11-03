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

// Route::get('/user', function () {
//     if (Auth::check()) {
//         return Auth::user();
//     }
//     return null;
// });

Route::get('/reminder', 'ReminderController@all');
Route::get('/reminder/{id}', 'ReminderController@show');
Route::put('/reminder/{id}', 'ReminderController@update');
Route::delete('/reminder/{id}', 'ReminderController@delete');
Route::post('/reminder/create', 'ReminderController@create');
Route::get('/record', 'RecordController@all');
Route::get('/record/{id}', 'RecordController@show');
Route::put('/record/{id}', 'RecordController@update');
Route::post('/record/create', 'RecordController@create');
