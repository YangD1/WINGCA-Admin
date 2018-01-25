<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $key_data = collect([
            'menus' => $request->menus,
            'active' => "users",
            'datas' => User::paginate(14)
        ]);

        return view('users/index',compact('key_data'));
    }

    /**
     * 添加用户提交
     */
    public function store(Request $request)
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
            return redirect()->intended('admin');
        }

    }

    /**
     * 更新用户信息(http:post)
     */
    public function update(Request $request)
    {
        //
        
        $user = User::find($request->id);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success', '用户信息更新成功！');
        return redirect()->route('users.index');
    }

    /**
     * 查看用户信息(ajax:post)
     */
    public function user_info(Request $request)
    {
        $data = User::find($request->id);
        echo json_encode($data);    
    }


    /**
     * 删除用户
     */
    public function destroy(Request $request)
    {
        User::find($request->id)->delete();        
        session()->flash('success','删除成功');
        return redirect()->route('users.index');
    }
}
