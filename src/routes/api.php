<?php

Route::group(['namespace' => 'Api'], function () {
    Route::post('login', 'AuthController@login');
    Route::middleware('auth:api')->post('/user', 'AuthController@getUser');
});

Route::namespace('Api\v1')->middleware('auth:api')->group(function () {
    Route::apiResource('users', 'UserController');
    Route::post('checkAppVersion', 'UserController@checkAppVersion');
    Route::post('getInformation', 'InformationController@getInformation');
});
