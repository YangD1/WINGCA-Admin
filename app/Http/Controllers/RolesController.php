<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RolesController extends Controller
{
    /**
     * 权限管理列表
     */
    public function index(Request $request)
    {
        //
        $key_data = collect([
            'menus' => $request->menus,
            'active' => "roles",
            'datas' => Role::paginate(14)
        ]);

        return view('roles/index',compact('key_data'));
    }

    /**
     * 创建权限提交(http:post)
     */
    public function store(Request $request)
    {
        //
       $this->validate($request, [
            'name' => 'required|max:50',
        ],[
            'name.required' => '请填写角色名称',
        ]);

        Role::create([
            'name' => $request->name
        ]);

        session()->flash('success', '创建成功！');
        return redirect()->route('roles.index');
    }

    /**
     * 更新权限提交(ajax:post)
     */
    public function update(Request $request)
    {
        //
        $role = Role::find($request->id);
        $this->validate($request, [
            'name' => 'required|max:50'
        ]);

        $data = [];
        $data['name'] = $request->name;
        $role->update($data);

        session()->flash('success', '用户信息更新成功！');
        return redirect()->route('roles.index');
    }

    /**
     * 权限删除(http:post)
     */
    public function destroy(Request $request)
    {
        Role::find($request->id)->delete();        
        session()->flash('success','删除成功');
        return redirect()->route('roles.index');
    }


    /**
     * 权限信息
     */
    public function role_info(Request $request)
    {
        $data = Role::find($request->id);
        echo json_encode($data);    
    }
}
