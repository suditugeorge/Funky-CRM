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

Route::match(['get','post'],'/', [
    'as' => 'login',
    'uses' => 'MainController@login',
]);

//For all this routes all users must be loged in
Route::group(['middleware' => 'isLogedIn'], function () {

    Route::get('/dashboard', [
        'uses' => 'UserController@dashboard',
        'as' => 'dashboard',
    ]);

});
