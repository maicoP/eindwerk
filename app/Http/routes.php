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
Route::resource('kot','kotController');

Route::get('/', 'homeController@index');
Route::get('/contact', 'homeController@contact');
Route::post('/images/delete/{id}','kotController@deleteImage');
Route::post('/message/send','homeController@sendMessage');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
