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

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('auth/permission', 'PermissionController');
Route::resource('auth/role', 'RoleController');
Route::resource('auth/user', 'UserController');
Route::resource('/notificacion', 'NotificationController');

Route::get('/auth/userxrol/{id}', 'UserController@userxrol');

Route::resource('/queja-reclamo', 'QuejaReclamoController');
Route::get('/queja-reclamo/file/{id}', 'QuejaReclamoController@file');

Route::resource('/area', 'AreaController');
Route::resource('/auditor', 'AuditorController');


Route::post('/auth/user/change-password', ['as' => 'user.change-password', 'uses' => 'UserController@changePassword']);

Route::get('/401', function(){
	return view('errors.401');
});

Route::get('/403', function(){
	return view('errors.403');
});

Route::get('/notifi',function(){
    //para prueba
    $user = User::find(2);
    $feed = feed();
    $feed->push(['from' => '3', 'body' => 'My awesome notification'
], $user);
});

