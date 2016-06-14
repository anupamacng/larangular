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


// API ROUTES ==================================  
Route::group(array('prefix' => 'api'), function() {

    // since we will be using this just for CRUD, we won't need create and edit
    // Angular will handle both of those forms
    // this ensures that a user can't access api/create or api/edit when there's nothing there
    Route::resource('employees', 'Employees', 
        array('only' => array('index', 'store', 'show')));
  
});





// Route::get('/api/v1/employees/{id?}', 'Employees@index');
// Route::post('/api/v1/employees', 'Employees@store');
// Route::post('/api/v1/employees/{id}', 'Employees@update');
// Route::delete('/api/v1/employees/{id}', 'Employees@destroy');
Route::get('/api/v1/users', 'UserController@index');
Route::get('/api/v1/getAllUsers/{id}', 'UserController@getUserListWithStatus');


// Route::post('/api/v1/register', 'UserController@store');
Route::post('/api/v1/login', 'UserController@login');
// Route::get('/api/v1/logout', 'UserController@logout');
// Route::post('/api/v1/update/{id}', 'UserController@update');
Route::post('/api/v1/addfriend/{id}', 'UserController@sendFriendRequest');
// Route::put('/api/v1/respondfriend/{id}', 'UserController@respondFriendRequest');
Route::get('/api/v1/viewuser/{id}', 'UserController@show');
Route::get('/api/v1/getfriendlist/{id}', 'UserController@getFriendList');



