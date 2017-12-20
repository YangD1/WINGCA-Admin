<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class loginController extends Controller
{
    /**
     *
     */
    public function index()
    {
        //
    }

    /**
     * 登陆会话创建视图
     */
    public function create()
    {
        if(Auth::check()){
            $url = route('home');
            header("Location: $url");
            exit;
          }
        return view("auth.login");
    }

    /**
     * 创建会话提交
     */
    public function store(Request $request)
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
       if (Auth::attempt($credentials)) {
           session()->flash('success', '欢迎回来！');
           return redirect()->route('home', [Auth::user()]);
       } else {
           session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
           return redirect()->back();
       }

       return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
