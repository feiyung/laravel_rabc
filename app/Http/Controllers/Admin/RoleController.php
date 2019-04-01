<?php
/**
 * Created by PhpStorm.
 * User: Adminer
 * Author: chexihuan
 * Date: 2019/3/14
 * Time: 16:22
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\AdminPermissions;
use App\Models\AdminRoles;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $role = new AdminRoles();

        $param = $this->request->only('role_name');

        $list = $role->roleList($param);

        return view('Admin.role.index',compact('list'));
    }

    public function create()
    {
        $permission = new AdminPermissions();
        $trueList = $permission->getTrueList();
        return view('Admin.role.create',compact('trueList'));
    }

    public function edit($id)
    {
        $role = new AdminRoles();

        $permission = new AdminPermissions();

        $roleInfo = $role->getRole($id);

        $trueList = $permission->getTrueList();//dd($trueList);

        /*foreach ($trueList as $v){
            foreach($v->permission as $item){
                dump($item->permission_name);
            }
        }exit;*/

        $permission_ids = $roleInfo->permission->pluck('id')->toArray();

        return view('Admin.role.edit',compact('roleInfo','trueList','permission_ids'));
    }

    public function store()
    {
        $role = new AdminRoles();

        $validator = $this->validate($this->request, [

            'role_name' => 'required|min:2|max:15|unique:admin_roles',

            'status' => 'required|numeric',

            'sort' => 'required|numeric',
        ]);
        if ($validator) {

            return falseAjax($validator->first());
        }
        $param = $this->request->only(['role_name', 'status', 'sort']);

        $result = $role->roleStore($param);

        if ($result) {

            return trueAjax('添加成功');

        } else {

            return falseAjax('添加失败');

        }

    }

    /**
     * @param $id
     * @Author : chexihuan
     * @Date : 2019/3/19 15:46
     * 更新角色
     */
    public function update($id)
    {

        $role = new AdminRoles();

        $validator = $this->validate($this->request, [

            'role_name' => 'required|min:2|max:15',

            'status' => 'required|numeric',

            'sort' => 'required|numeric',
        ]);
        if ($validator) {

            return falseAjax($validator->first());
        }
        $param = $this->request->only(['role_name', 'status', 'sort']);


        DB::beginTransaction();
        try{
            $role->roleUpdate($id,$param);


            $roleInfo = $role->getRole($id);

            $roleInfo->permission()->sync($this->request->permission);

            DB::commit();

            return trueAjax('更新成功');
        }
        catch (\Exception $e)
        {
            DB::rollBack();

            return falseAjax('更新失败');
        }
    }

    public function updateStatus()
    {
        $role = new AdminRoles();

        $data = $this->request->only(['id','status']);

        $result = $role->status($data);

        if($result){

            return trueAjax('更新成功');

        }else{

            return falseAjax('更新失败');
        }
    }
}