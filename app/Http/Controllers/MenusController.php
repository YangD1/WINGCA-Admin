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
     *  菜单列表
     */
    public function index(Request $request)
    {
        //
        // $title = "菜单管理";
        // $menus = $request->menus;
        // $active = 'menus';
        // $key_data = [
        //     $title => "菜单管理",
        //     $menus => $request->menus,
        //     $active => 'menus'
        // ];

        $key_data = collect([
            'menus' => $request->menus,
            'active' => "menus",
            'datas' => Menu::paginate(14),
            'parent_data' => Menu::whereRaw('parent_id = 0')->get(),
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
        //
        $data = [
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'name_index' => $request->name_index,
            'parent_id' => $request->parent_id
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

    public function update(Request $request, $id)
    {
        //
        $data = [
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'name_index' => $request->name_index,
            'parent_id' => $request->parent_id
        ];
        Menu::find($request->id)->update($data);
        session()->flash('success','更新成功');
        return redirect()->route('menus.index');
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

        echo json_encode($data);
     }

}
