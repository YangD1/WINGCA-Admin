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
            $request->menus = Menu::All();
        }else{
            return redirect()->route('login');
        }

        return $next($request);
    }
}
