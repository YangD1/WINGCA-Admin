<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Menu;
use App\Models\Role;

class GetMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            // 获取当前可以操作的栏目id
            $access_menus_id = Role::find(Auth::user()->role->role_id) ? Role::find(Auth::user()->role->role_id)->access_menus_id : "";
            // 查找所有一级栏目
            // $parent_menus = Menu::whereRaw("parent_id = 0")->get();
            $parent_menus = Menu::whereRaw("FIND_IN_SET(id,?) AND parent_id = 0",[$access_menus_id])->get();
            foreach( $parent_menus as $k => $v ){
                $v->child_menus = Menu::whereRaw("parent_id = ?",[$v->id])->get();
            }
            $request->menus = $parent_menus;
        }
        return $next($request);
    }
}
