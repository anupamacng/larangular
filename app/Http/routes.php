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
    return view('index');
});
// Route::get('/', 'Employees@index');

Route::get('/api/v1/users', 'UserController@index');
Route::get('/api/v1/getAllUsers/{id}', 'UserController@getUserListWithStatus');
Route::post('/api/v1/register', 'UserController@register');
Route::post('/api/v1/login', 'UserController@login');
Route::get('/api/v1/logout', 'UserController@logout');
Route::post('/api/v1/update/{id}', 'UserController@update');
Route::post('/api/v1/addfriend/{id}', 'UserController@sendFriendRequest');
Route::put('/api/v1/respondfriend/{id}', 'UserController@respondFriendRequest');
Route::get('/api/v1/viewuser/{id}', 'UserController@show');
Route::get('/api/v1/getfriendlist/{id}', 'UserController@getFriendList');



