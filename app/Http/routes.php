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
Route::get('/', function () {
    return view('index/index');
});

Route::get('home',function(){
    return view('index/index');
})->name('home');

// // 认证路由...
// Route::get('auth/login', 'Auth\AuthController@getLogin');
// Route::post('auth/login', 'Auth\AuthController@postLogin');
// Route::get('auth/logout', 'Auth\AuthController@getLogout');
//
// // 注册路由...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

# 登陆会话
Route::get('login', 'loginController@create')->name('login');
Route::post('login', 'loginController@store')->name('login');
Route::get('logout', 'loginController@destroy')->name('logout');
