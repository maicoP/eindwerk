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
Route::resource('user','usersController');
Route::get('/', 'homeController@index');

Route::get('/api/getKot', 'apiController@getKot');
Route::get('/api/vote', 'apiController@vote');
Route::get('/api/changevote', 'apiController@changeVote');
Route::get('/api/changefilter', 'apiController@changeFilter');
Route::get('/api/favkotten', 'apiController@favKotten');
Route::get('/api/getappuser', 'apiController@getAppUser');
Route::get('/api/checkuser', 'apiController@checkUser');
Route::get('/api/register', 'apiController@register');
Route::get('/api/getschools', 'apiController@getSchools');
Route::get('/api/savefilter', 'apiController@saveFilter');
Route::get('/api/resetkotten', 'apiController@resetKotten');
Route::get('/api/login', 'apiController@login');
Route::get('/api/fblogin', 'apiController@fbLogin');

Route::get('/contact', 'homeController@contact');
Route::get('/help', 'kotController@help');
Route::post('/images/delete/{id}','kotController@deleteImage');
Route::post('/message/send','homeController@sendMessage');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'eindwerk\Http\Middleware\AdminMiddleware'], function()
{
    Route::resource('user','usersController');
    Route::get('manage/kot','kotController@manageKot');

});
