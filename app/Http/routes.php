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

Route::group(['middleware' => ['web']], function () {

    Route::post('/login', 'Auth\AuthController@login');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', 'Auth\AuthController@logout');
    });

    Route::get('/admin', function () {
        return view('welcome');
    });

    Route::get('/home', 'HomeController@index');

    Route::get('/admin/user', 'HomeController@user');
    
    Route::get('/admin/user/{id}/downloads', 'HomeController@userDownloads');

    Route::get('/admin/image/{dirName}/{filename}', 'HomeController@image');
    
    Route::get('/admin/download/{dirName}/{filename}', 'HomeController@download');

    Route::post('/admin/login', 'Auth\AuthController@adminLogin');

    Route::get('/login', function () {
        return view('auth.login');
    });
});


Route::any('{path?}', function()
{
    return File::get(public_path() . '/index.html');
})->where("path", ".+");