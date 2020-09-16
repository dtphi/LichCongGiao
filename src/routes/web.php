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

Route::namespace('Auth')
    ->group(function () {
        Route::any('/logout', 'AdminLoginController@logout')->name('logout');
        Route::post('/login', 'AdminLoginController@loginAdmin')->name('post.login');
        Route::get('/', 'AdminLoginController@showLoginForm')->name('login');

        Route::get('/forget', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('/forget/exec', 'ForgotPasswordController@sendResetLinkEmailMember')->name('password.request.exec');
        Route::get('/forget/exec/complete',
            'ForgotPasswordController@showRequestComplete')->name('password.request.complete');

        Route::get('/passchange/{token}', 'ResetPasswordController@showResetForm')->name('passchange');
        Route::post('/passchange/exec', 'ResetPasswordController@resetAdmin')->name('passchange.exec');
        Route::get('/passchange/complete', 'ResetPasswordController@showRequestComplete')->name('passchange.complete');
    });

Route::namespace('Admin')
    ->middleware(['auth', 'checkRole'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        Route::any('/version', 'VersionController@index')->name('version.index');

        Route::get('/user', 'UserController@indexMiddlewareUser')->name('user.index');
        Route::any('/user/regist', 'UserController@registryMiddlewareUser')->name('user.registry');
        Route::any('/user/detail/{user_id}', 'UserController@detailMiddlewareUser')->name('user.detail');
        Route::post('/user/delete', 'UserController@delete')->name('user.delete');
        Route::get('/user/activity/{user_id}', 'UserController@activityUser')->name('user.activity');

        Route::get('/info', 'InformationController@index')->name('info.index');
        Route::any('/info/regist', 'InformationController@registryMiddlewareInfo')->name('info.registry');
        Route::any('/info/detail/{info_id}', 'InformationController@detailMiddlewareInfo')->name('info.detail');
        Route::post('/info/delete', 'InformationController@delete')->name('info.delete');

        Route::get('/faq', 'FaqController@index')->name('faq.index');
    });
