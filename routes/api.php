<?php

Route::group(['middleware' => 'throttle:10000'], function () {

    // Volunteers
    Route::get('/volunteers', 'Api\volunteersController@index');

});
