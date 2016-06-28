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
Route::resource('users', 'UsersController');
Route::resource('reminders', 'RemindersController');
Route::resource('notes', 'NotesController');
Route::auth();
Route::post('/login', 'AuthController@login');
Route::get('/samples', 'UsersController@index');
Route::get('/register','Auth\AuthController@register');
Route::get('notes/{id}/delete','NotesController@destroy');
Route::get('users/check/{username}','UsersController@checkUsername');
Route::get('/', function () {
    if(Auth::check()) {
        return redirect('reminders');
    
}    Auth::logout();
    return view('index');
});

