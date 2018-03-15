<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Menu;

class RolesController extends Controller
{
    /**
     * 限制只有超级管理员才可以访问
     */
    function __construct()
    {
        $this->authorize('adminSee', \App\Models\Menu::class);
    }
    /**
     * 权限管理列表
     */
    public function index(Request $request)
    {
        // 调用所有栏目
        $allMenus = Menu::whereRaw("menu_lv = 1")->get();
        foreach( $allMenus as $k => $v ){
            $v->child_menus = Menu::whereRaw("parent_id = ?",[$v->id])->get();
            foreach( $v->child_menus as $key => $value ){
                $value->son_menus = Menu::whereRaw("parent_id = ?",[$value->id])->get();
            }
        } 
        $key_data = collect([
            'menus' => $request->menus,
            'all_menus' => $allMenus,
            'active' => "roles",
            'datas' => Role::paginate(14),
            'menus_data' => Menu::all()
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
            'name' => 'required|max:50'
        ],[
            'name.required' => '请填写角色名称'
        ]);

        $data = [];

        $data['name'] = $request->name;
        
        if($request->access_menus_id){
            $data['access_menus_id'] = $request->access_menus_id;
        }

        Role::create($data);

        session()->flash('success', '角色创建成功！');
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
            'name' => 'required|max:50',
            'access_menus_id' => 'required'
        ],[
            'name.required' => '请填写角色名称',
            'access_menus_id.required' => '必须选择可以管理的栏目'
        ]);

        $data = [];
        $data['name'] = $request->name;
        $data['access_menus_id'] = implode(',',$request->access_menus_id);
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
        $data->access_menus_id = explode(",",$data->access_menus_id);
        echo json_encode($data);    
    }
}
