<?php
/**
 * Created by PhpStorm.
 * User: Adminer
 * Author: chexihuan
 * Date: 2019/3/18
 * Time: 10:17
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\AdminUser;

class LoginController extends Controller
{
    public function index()
    {
        return view('Admin.login');
    }

    /**
     * @Author : chexihuan
     * @Date : 2019/3/18 14:30
     * 用户登录
     */
    public function login()
    {

        $admin = new AdminUser();

        $validator = $this->validate($this->request, [

            'uname' => 'required|min:2|max:15',

            'password' => 'required|min:6|max:20',
        ]);

        if ($validator) {

            return falseAjax($validator->first());
        }
        $admin->login($this->request->uname);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @Author : chexihuan
     * @Date : 2019/3/18 14:30
     * 退出
     */
    public function loginOut()
    {
        session()->forget('admin_user');

        return redirect()->route('admin.login.index');;
    }
}