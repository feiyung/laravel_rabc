<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        if (!session('admin_user')) {

            if($request->ajax()){
                return falseAjax('请重新登录');
            }else{
                return redirect()->guest('/admin');
            }

        }
        return $next($request);
    }
}
