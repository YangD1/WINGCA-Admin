<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Menu;

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
            // 在此判断当前用户各个栏目访问权限

            // 查找所有一级栏目
            $parent_menus = Menu::whereRaw("parent_id = 0")->get();
            foreach( $parent_menus as $k => $v ){
                $v->child_menus = Menu::whereRaw("parent_id = ?",[$v->id])->get();
            }
            $request->menus = $parent_menus;
        }
        return $next($request);
    }
}
