<?php
/**
 * Created by PhpStorm.
 * User: Adminer
 * Author: chexihuan
 * Date: 2019/3/14
 * Time: 16:23
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\AdminPermissions;

class PermissionController extends Controller
{
    public function index()
    {

        $permission = new AdminPermissions();

        $param = $this->request->only('route');

        $list = $permission->getList($param);
        return view('Admin.permission.index',compact('list'));
    }

    public function create()
    {
        $permission = new AdminPermissions();

        $list = $permission->getTopList();

        return view('Admin.permission.create',compact('list'));
    }

    public function edit($id)
    {

        $permission = new AdminPermissions();

        $info = $permission->getInfo($id);

        $list = $permission->getTopList($id);


        return view('Admin.permission.edit',compact('info','list'));
    }

    public function store()
    {
        $permission = new AdminPermissions();

        $validator = $this->validate($this->request, [

            'permission_name' => 'required|max:20|unique:admin_permissions',

            'route' => 'required|max:100|unique:admin_permissions',

            'remark' => 'nullable|max:100',

            'level' => 'required|numeric',

            'pid' => 'required|numeric',

            'sort' => 'required|numeric',

            'status' => 'required|numeric',

            'is_menu' => 'required|numeric',

            /*'menu_url' => 'nullable|string',*/

            'menu_icon' => 'nullable|string',
        ]);
        if ($validator) {

            return falseAjax($validator->first());
        }

        $param = $this->request->except(['_token']);

        $result = $permission->permissioStore($param);

        if ($result) {

            return trueAjax('添加成功');

        } else {

            return falseAjax('添加失败');

        }
    }

    /**
     * @Author : chexihuan
     * @Date : 2019/3/20 16:03
     * 设置权限状态
     */
    public function updateStatus()
    {
        $permission = new AdminPermissions();

        $data = $this->request->only(['id','status']);

        $result = $permission->status($data);

        if($result){

            return trueAjax('更新成功');

        }else{

            return falseAjax('更新失败');
        }
    }

    /**
     * @param $id
     * @Author : chexihuan
     * @Date : 2019/3/20 16:03
     * 权限更新
     */
    public function update($id)
    {

        $permission = new AdminPermissions();

        $validator = $this->validate($this->request, [

            'permission_name' => 'required|max:20',

            'route' => 'required|max:100',

            'remark' => 'nullable|max:100',

            'level' => 'required|numeric',

            'pid' => 'required|numeric',

            'sort' => 'required|numeric',

            'status' => 'required|numeric',

            'is_menu' => 'required|numeric',

            /*'menu_url' => 'nullable|string',*/

            'menu_icon' => 'nullable|string',
        ]);
        if ($validator) {

            return falseAjax($validator->first());
        }
        $param = $this->request->except(['_token']);


        $result = $permission->permissionUpdate($id,$param);

        if($result){

            return trueAjax('更新成功');

        }else{

            return falseAjax('更新失败');
        }
    }
}