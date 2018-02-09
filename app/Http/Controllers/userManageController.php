<?php
/**
 * 用户管理（用户自我管理） 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Http\Controllers\Tools;

class userManageController extends Controller
{
    public $tools;
    function __construct()
    {
        $this->tools = new Tools();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * 编辑当前登录用户自己的信息(视图)
     */
    public function edit($id, Request $request)
    {
       $data = User::find($id); 
        $key_data = collect([
            'menus' => $request->menus,
            'active' => "none",
            'data' => $data
        ]);
       return view('users/edit',compact('key_data')); 
    }

    /**
     * 用户更新信息(PATCH提交请求)
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
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

        session()->flash('success', '个人信息更新成功！');
        return redirect()->route('user.edit',$id);
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
}
