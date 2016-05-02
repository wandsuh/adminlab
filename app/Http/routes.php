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

Route::get('/', 'HomeController@index');

Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => ['auth:web']], function () {
        //codingan route
        Route::get('logout' , 'LoginController@logout');
        Route::get('home' , 'HomeController@index');
        Route::get('orders' , 'OrdersController@index');
        Route::get('orders/show/{id}' , 'OrdersController@show');
        Route::post('orders/search' , 'OrdersController@search');

        Route::get('status' , 'StatusController@index');
        Route::get('status/edit/{id}' , 'StatusController@edit');
        Route::post('status/update' , 'StatusController@update');
        Route::post('status/search' , 'StatusController@search');
    });

    Route::get('login' , 'LoginController@login');
    Route::post('dologin' , 'LoginController@dologin');
    Route::get('register' , 'LoginController@register');
    Route::post('doregister' , 'LoginController@doregister');
    Route::post('getlabbyid' , 'LoginController@getlabbyid');
});