<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api'
], function () {
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('refresh', 'AuthController@refresh')->name('refresh');
        Route::post('me', 'AuthController@me')->name('me');
    });
    Route::group([
        'prefix' => 'blogs/'
    ], function () {
        Route::get('', 'BlogController@all')->name('blog.all');
        Route::get('{id}', 'BlogController@show')->name('blog.show');
        Route::post('', 'BlogController@store')->name('blog.store');
        Route::put('{id}', 'BlogController@update')->name('blog.update');
        Route::delete('{id}', 'BlogController@destroy')->name('blog.delete');
    });
});