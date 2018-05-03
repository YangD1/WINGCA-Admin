<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Menu;

class MenusController extends Controller
{
    /**
     * 限制只有超级管理员才可以访问
     */
    function __construct()
    {
       $this->authorize('adminSee', \App\Models\Menu::class); 
    }

    /**
     *  菜单列表
     */
    public function index(Request $request)
    {

        $key_data = collect([
            'menus' => $request->menus,
            'active' => "menus",
            'datas' => Menu::paginate(14),
            'parent_data' => Menu::whereRaw('menu_lv < 3')->get(),
        ]);

        return view("sets/menus/index",compact('datas','parent_data','key_data'));
    }

    /**
     *
     */
    public function create()
    {
        //
    }

    /**
     * 提交新的 menu 项目
     */
    public function store(Request $request)
    {
        // 获取当前新建栏目的父级栏目的栏目等级
        $menu_lv = Menu::find($request->parent_id) ? (Menu::find($request->parent_id)->menu_lv) + 1 : 1; 
        $data = [
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'name_index' => $request->name_index,
            'parent_id' => $request->parent_id,
            'menu_lv' => $menu_lv
        ];
        Menu::create($data);
        session()->flash('success','添加成功');
        return redirect()->route('menus.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {

        // 判断当前栏目的等级变化
        $menu_lv = Menu::find($request->parent_id) ? (Menu::find($request->parent_id)->menu_lv) + 1 : 1;

        if($request->parent_id == $request->id){
            session()->flash('warning','不可以选中栏目本身为父栏目');
            return redirect()->back();
        };

        $data = [
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'name_index' => $request->name_index,
            'parent_id' => $request->parent_id,
            'menu_lv' => $menu_lv
        ];
        Menu::find($request->id)->update($data);
        session()->flash('success','更新成功');
        return redirect()->back();
    }

    /**
     * 删除 menu 项目
     */
    public function destroy(Request $request)
    {
        Menu::find($request->id)->delete();
        session()->flash('success','删除成功');
        return redirect()->route('menus.index');
    }

    /**
     * 调用menus信息
     * 请求：id - 操作的menu id
     * 返回：相应的menu数据（json）
     */
     public function menu_info(Request $request){
        $data = Menu::find($request->id);
        // 用户授权
        $menus = Menu::findOrFail($request->id);
        $this->authorize('update',$menus);

        return $data;
     }

}
