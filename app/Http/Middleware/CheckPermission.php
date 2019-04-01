<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CheckPermission
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

        if (session('admin_user')) {
            $roles = session('admin_user')->role()->get();

            $permission = [];
            $route = Route::currentRouteName();
            foreach ($roles as &$v){
                $permission = array_merge($permission,$v->permission()->where('status',1)->pluck('route')->toArray());
            }
            $permission = array_unique($permission);

            if(!in_array($route,$permission)){
                if($request->ajax()){
                return falseAjax('您无权限操作');
                }else{
                    return redirect()->route('admin.permissionInfo');

                }
            }


        }
        return $next($request);
    }
}
