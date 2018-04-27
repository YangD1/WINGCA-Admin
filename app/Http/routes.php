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

/**
 * 前台路由
 */
# 默认根访问
Route::get('/',function(){
    return view('welcome');
});


# 登陆会话 (User)
Route::get('login', 'SessionController@login')->name('login');
Route::post('login', 'SessionController@login_store')->name('login');
Route::get('logout', 'SessionController@logout')->name('logout');
# 注册(User)
Route::get('register', 'SessionController@register')->name('register');
Route::post('register', 'SessionController@register_store')->name('register');

# 文件上传
Route::post('file_upload', 'Tools@file_upload')->name('file_upload');


/**
 * 后台路由
 */

# 后台根路径
Route::get('/admin',"AdminController@index")->name('admin')->middleware('CheckAdminSignIn');

# 其他 后台路由
Route::group(['prefix' => 'admin'],function(){
    # 后台用户会话相关路由(App/User)
    Route::get('login','AdminSessionController@login')->name('admin.login');
    Route::post('login','AdminSessionController@login_store')->name('admin.login');
    Route::get('register','AdminSessionController@register')->name('admin.register');
    Route::post('register','AdminSessionController@register_store')->name('admin.register');
    Route::get('logout','AdminSessionController@logout')->name('admin.logout');

    # 用户管理路由(Model: App/User)
    Route::group(['middleware'=>'CheckAdminSignIn','prefix'=>'users'],function(){
        Route::get('/','UsersController@index')->name('users.index');
        Route::post('store','UsersController@store')->name('users.store');
        Route::patch('update','UsersController@update')->name('users.update');
        Route::delete('destroy','UsersController@destroy')->name('users.destroy');
        
        // 用户信息(ajax)
        Route::post('user_info','UsersController@user_info')->name('users.info');

        // 用户自我管理
        Route::get('edit/{id}','userManageController@edit')->name('user.edit');
        Route::patch('update/{id}','userManageController@update')->name('user.update');
    });

    # 菜单管理路由(Model: App/Models/Menu)
    Route::group(['middleware'=>'CheckAdminSignIn','prefix'=>'menus'],function(){
        Route::get('/','MenusController@index')->name('menus.index');
        Route::post('store','MenusController@store')->name('menus.store');
        Route::patch('update','MenusController@update')->name('menus.update');
        Route::delete('destroy','MenusController@destroy')->name('menus.destroy');
    
        // 菜单信息(ajax) 
        Route::post('menu_info','MenusController@menu_info')->name('menus.info');
    });

    
    # 角色权限路由(Model: App/User)
    Route::group(['middleware'=>'CheckAdminSignIn','prefix'=>'roles'],function(){
        Route::get('/','RolesController@index')->name('roles.index');
        Route::post('store','RolesController@store')->name('roles.store');
        Route::patch('update','RolesController@update')->name('roles.update');
        Route::delete('destroy','RolesController@destroy')->name('roles.destroy');

        // 权限信息(ajax)
        Route::post('role_info','RolesController@role_info')->name('roles.info');
    });


});




