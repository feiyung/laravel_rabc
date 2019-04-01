<?php
/**
 * Created by PhpStorm.
 * User: Adminer
 * Author: chexihuan
 * Date: 2019/3/13
 * Time: 13:22
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\AdminRoles;
use App\Models\AdminUser;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @Author : chexihuan
     * @Date : 2019/3/18 16:33
     * 管理员列表
     */
    public function index()
    {
        $admin = new AdminUser();

        $param = $this->request->only('uname', 'mobile', 'nickname');

        $list = $admin->adminList($param);

        return view('Admin.adminer.index', compact('list'));
    }

    public function create()
    {
        $role = new AdminRoles();

        $list = $role->getRule();


        return view('Admin.adminer.create',compact('list'));
    }

    public function edit($id)
    {
        $admin = new AdminUser();

        $role = new AdminRoles();

        $list = $role->getRule();

        $info = $admin->getInfo($id);

        $role_ids = $info->role->pluck('id')->toArray();

        return view('Admin.adminer.edit',compact('info','list','role_ids'));
    }

    /**
     * @Author : chexihuan
     * @Date : 2019/3/19 15:01
     * 添加用户
     */
    public function store()
    {
        $admin = new AdminUser();

        $validator = $this->validate($this->request, [

            'uname' => 'required|min:2|max:15|unique:admin_users',

            'nickname' => 'required|min:2|max:15',

            'password' => 'required|min:6|max:20|confirmed',

            'password_confirmation' => 'required|min:6',

            'mobile' => 'required|regex:/^1[3,4,5,6,7,8,9]\d{9}$/i|unique:admin_users',

            'status' => 'required|numeric',
        ]);
        if ($validator) {

            return falseAjax($validator->first());
        }
        $param = $this->request->only(['uname', 'nickname', 'password', 'mobile', 'status']);

        DB::beginTransaction();
        try{
            $result = $admin->adminStore($param);

            $result->role()->sync($this->request->role);

            DB::commit();

            return trueAjax('添加成功');
        }
        catch (\Exception $e)
        {
            DB::rollBack();

            return falseAjax('添加失败');
        }



    }

    /**
     * @param $id
     * @Author : chexihuan
     * @Date : 2019/3/19 13:24
     * 更新用户
     */
    public function update($id)
    {

        $admin = new AdminUser();

        $validator = $this->validate($this->request, [

            'uname' => 'required|min:2|max:15',

            'nickname' => 'required|min:2|max:15',

            'password' => 'nullable|min:6|max:20|confirmed',

            'password_confirmation' => 'nullable|min:6',

            'mobile' => 'required|regex:/^1[3,4,5,6,7,8,9]\d{9}$/i',

            'status' => 'required|numeric',
        ]);
        if ($validator) {

            return falseAjax($validator->first());
        }
        if(isset($this->request->password)){
            $param = $this->request->only(['uname', 'nickname', 'password', 'mobile', 'status']);
        }else{
            $param = $this->request->only(['uname', 'nickname', 'mobile', 'status']);
        }




        DB::beginTransaction();
        try{
            $admin->adminUpdate($id,$param);

            $info = $admin->getInfo($id);

            $info->role()->sync($this->request->role);

            DB::commit();

            return trueAjax('更新成功');
        }
        catch (\Exception $e)
        {
            DB::rollBack();

            return falseAjax('更新失败');
        }
    }

    /**
     * @Author : chexihuan
     * @Date : 2019/3/19 13:24
     * 用户启用状态
     */
    public function updateStatus()
    {
        $admin = new AdminUser();

        $data = $this->request->only(['id','status']);

        $result = $admin->status($data);

        if($result){

            return trueAjax('更新成功');

        }else{

            return falseAjax('更新失败');
        }


    }
}