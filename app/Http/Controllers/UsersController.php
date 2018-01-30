<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Role;
use App\Models\UserRole;

class UsersController extends Controller
{
   /**
    * 限制只有超级管理员才可以访问
    */
    function __construct()
    {
        $this->authorize('adminSee', \App\Models\Menu::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = User::paginate(14);
        foreach($datas as $k=>$v){
            // 判断分配的相关权限
            if($v->role){
                $datas[$k]['role'] = Role::find($v->role->role_id) ? Role::find($v->role->role_id)->name : "关联权限不存在";
            }
        }
        $key_data = collect([
            'menus' => $request->menus,
            'active' => "users",
            'datas' => $datas,
            'role_datas' => Role::all()
        ]);

        return view('users/index',compact('key_data'));
    }

    /**
     * 提交创建新用户 
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
        // 角色创建成功，新建关联的角色信息(to table: user_roles)
        UserRole::create(['user_id'=>$user->id, 'role_id'=>$request->role_id]);
        session()->flash('success', '用户创建成功！');
        return redirect()->route('users.index');

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

        if($user->role){
            $user->role->update(['role_id'=>$request->role_id]); 
        }else{
            UserRole::create(['user_id'=>$user->id, 'role_id'=>$request->role_id]);
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
        // 调用权限id
        $data['role_id'] = User::find($request->id)->role ? User::find($request->id)->role->role_id : 0;
        echo json_encode($data);    
    }


    /**
     * 删除用户
     */
    public function destroy(Request $request)
    {
        // 先删除相关的权限信息
        User::find($request->id)->role()->delete();
        // 删除用户
        User::find($request->id)->delete();        
        session()->flash('success','删除成功');
        return redirect()->route('users.index');
    }
}
