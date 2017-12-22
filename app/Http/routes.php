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

// 根路径
Route::get('/', function () {
    if(Auth::check()){
        return view('index/index');
    }else{
        return redirect()->route('login');
    }
});

// 项目首页
Route::get('home',function(){
    if(Auth::check()){
        return view('index/index');
    }else{
        return redirect()->route('login');
    }
})->name('home');

# 登陆会话
Route::get('login', 'loginController@create')->name('login');
Route::post('login', 'loginController@store')->name('login');
Route::get('logout', 'loginController@destroy')->name('logout');

# 注册
Route::get('register', 'registerController@create')->name('register');
Route::post('register', 'registerController@store')->name('register');
