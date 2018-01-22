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

# 根路径
Route::get('/',['middleware'=>'CheckSignIn',function (Request $request) {
    $menus = $request->menus;
    $active = "home";
    return view('index/index',compact('menus','active'));
}]);

# 项目首页
Route::get('home',['middleware'=>'CheckSignIn',function (Request $request){
    $menus = $request->menus;
    $active = "home";
    return view('index/index',compact('menus','active'));
}])->name('home');

# 菜单管理路由
Route::group(['middleware'=>'CheckSignIn'],function(){
    Route::resource('menus','MenusController');
    // 菜单信息 ajax 请求接口
    Route::post('menu_info','MenusController@menu_info')->name('menu_info');
});


// User 模型
// Route::resource('users','UsersController');
Route::group(['middleware'=>'CheckSignIn','prefix'=>'users'],function(){
    Route::get('/','UsersController@index');
});
