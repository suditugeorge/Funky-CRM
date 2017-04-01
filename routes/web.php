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

Route::match(['get', 'post'], '/', [
    'as' => 'login',
    'uses' => 'MainController@login',
]);

//For all this routes all users must be loged in
Route::group(['middleware' => 'isLogedIn'], function () {

    Route::get('/dashboard', [
        'uses' => 'UserController@dashboard',
        'as' => 'dashboard',
    ]);

    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'MainController@logout',
    ]);

    Route::post('/change-profile-photo', [
        'uses' => 'UserController@changeProfilePhoto',
    ]);

    Route::post('/change-user-profile', [
        'uses' => 'UserController@updateProfile',
    ]);

    Route::resource('media', 'MediaController');
    Route::resource('volunteers', 'VolunteersController');

    Route::get('/users', [
        'as' => 'users',
        'uses' => 'UserController@searchUsers',
    ]);

    //For all this routes all users must be admins
    Route::group(['middleware' => 'isLogedIn'], function () {

        Route::match(['get','post'], '/add-funky', [
            'uses' => 'UserController@addFunkyUser',
        ]);

    });

});
