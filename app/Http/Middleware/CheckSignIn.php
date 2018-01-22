<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckSignIn
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
        // 判断用户是否登录 没登录返回到登录页面
        if(Auth::check()){
            return $next($request);
        }else{
            return redirect()->route('login');
        }
    }
}
