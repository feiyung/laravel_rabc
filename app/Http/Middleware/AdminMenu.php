<?php

namespace App\Http\Middleware;

use App\Models\AdminPermissions;
use Closure;
use Illuminate\Support\Facades\Route;

class AdminMenu
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

            $topmenu = AdminPermissions::where(['is_menu'=>1,'level'=>1])
                ->whereIn('route',$permission)
                ->get(['permission_name','pid','route','menu_icon','id']);

            foreach ($topmenu as &$v){
                $v->children = $v->permission()->whereIn('route',$permission)->get(['permission_name','pid','route','menu_icon','id']);
            }
            $pid = AdminPermissions::where('route',$route)->first(['pid']);

            view()->share('share', ['menu' => $topmenu,'route'=>$route,'pid'=>$pid?$pid->pid:0]);



        }
        return $next($request);
    }
}
