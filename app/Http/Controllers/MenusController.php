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
        if(Auth::check()){
            $title = "菜单管理";
            $menus = $request->menus;
            $active = 'menus';
            $datas = Menu::paginate(14);
            return view("sets/menus/index",compact('title','menus','active','datas'));
        }else{
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd('添加新的menu');
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
        dd('在这里更新menu信息');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 调用menus信息
     * 请求：id - 操作的menu id
     * 返回：相应的menu数据（json）
     */
     public function menu_info(Request $request){
        $data = Menu::find($request->id);
         $menus = Menu::findOrFail($request->id);
          $this->authorize('update',$menus);
        echo json_encode($data);
     }

    /**
     * 删除menus信息
     */
     public function menu_del(Reuqest $request){
         echo "删除菜单".$request->id;
     }

}
