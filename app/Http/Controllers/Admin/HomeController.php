<?php

/**
 * Created by PhpStorm.
 * User: Adminer
 * Author: chexihuan
 * Date: 2018/12/27
 * Time: 13:58
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {

        return view('Admin.home',compact('envs'));
    }

    public function permissionInfo()
    {
        return view('Admin.permissioninfo');
    }
}