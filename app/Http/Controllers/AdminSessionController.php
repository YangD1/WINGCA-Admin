<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class AdminSessionController extends Controller
{
    /**
     * 登陆会话创建视图
     */
    public function login()
    {
        if( Auth::check() ){
            return redirect()->route('admin');
        }
        return view("admin_auth.login");
    }

    /**
     * 创建会话提交
     */
    public function login_store(Request $request)
    {
        // 格式验证
       $this->validate($request, [
          'email' => 'required|email|max:255',
          'password' => 'required'
       ]);

       // 需要 用户验证 的字段
       $credentials = [
         'email'    => $request->email,
         'password' => $request->password,
       ];

       // 用户认证
       if ( Auth::attempt($credentials) ) {
           // 认证通过生成会话之后要验证下权限表中相关的数据，然后进行操作
           session()->flash('success', '欢迎回来！');
           return redirect()->route('admin', [Auth::user()]);
       } else {
           session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
           return redirect()->back();
       }

       return;
    }

    /**
     * 注册视图
     */    
    public function register()
    {
        if(Auth::check()){
            $url = route('/');
            header("Location: $url");
            exit;
        }
        return view("admin_auth.register");
    } 

    /**
     * 注册提交
     */
    public function register_store()
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required'
        ],[
            'name.required' => '请填写姓名',
            'email.required' => '邮箱必填',
            'email.email' => '请使用正确的邮箱格式',
            'password.required' => '请填写正确的密码',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // 认证通过...
            session()->flash('success', '创建成功！');
            return redirect()->intended('home');
        }
    } 

    /**
     * 退出登录
     */
    public function logout()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect()->route('admin.login');
    }
}
