<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Menu;

class prototype
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
            // 在此判断权限并且进行栏目对象的声明

            // 查找所有一级栏目
            $parent_menus = Menu::whereRaw("parent_id = 0")->get();
            foreach( $parent_menus as $k => $v ){
                $v->child_menus = Menu::whereRaw("parent_id = ?",[$v->id])->get();
            }
            // foreach( $parent_menus as $v ){
            //     foreach ($v->child_menus as $key => $value) {
            //         echo $value->name;
            //     }
            // }
            // die;
            // $menus = Menu::All();
            // foreach($menus as $v){
            //     if(in_array($v->parent_id,$parent_menus)){
            //         echo "在栏目".$v->parent_id."中 栏目名称为".$v->name,'<br>';
            //     }
            // }
            $request->menus = $parent_menus;
        }
        return $next($request);
    }
}
