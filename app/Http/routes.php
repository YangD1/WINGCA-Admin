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
use Illuminate\Http\Request;

# 登陆会话
Route::get('login', 'loginController@create')->name('login');
Route::post('login', 'loginController@store')->name('login');
Route::get('logout', 'loginController@destroy')->name('logout');

# 注册
Route::get('register', 'registerController@create')->name('register');
Route::post('register', 'registerController@store')->name('register');

// 根路径
Route::get('/',['middleware' => 'prototype', function (Request $request) {
    if(Auth::check()){
        $menus = $request->menus;
        $active = "home";
        return view('index/index',compact('menus','active'));
    }else{
        return redirect()->route('login');
    }
}]);

// 项目首页
Route::get('home',['middleware' => 'prototype',function (Request $request){
    if(Auth::check()){
        $menus = $request->menus;
        $active = "home";
        return view('index/index',compact('menus','active'));
    }else{
        return redirect()->route('login');
    }
}])->name('home');

// 菜单管理路由
Route::resource('menus','MenusController');
