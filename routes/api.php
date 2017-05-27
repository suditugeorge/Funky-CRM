<?php

Route::group(['middleware' => 'throttle:10000'], function () {

    // Volunteers
    Route::get('/volunteers', 'Api\VolunteersController@index');
    Route::get('/media', 'Api\ContactsController@media');
    Route::get('/donors', 'Api\ContactsController@donors');
    Route::get('/politicians', 'Api\ContactsController@politicians');
    Route::get('/colaborators', 'Api\ContactsController@colaborators');
    Route::get('/employees', 'Api\ContactsController@employees');

});
