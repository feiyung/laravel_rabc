<?php
/**
 * Created by PhpStorm.
 * User: Adminer
 * Author: chexihuan
 * Date: 2019/3/15
 * Time: 16:27
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AdminRoles extends Model
{
    protected $table = 'admin_roles';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsToMany(AdminUser::class,'role_user','role_id','user_id')->withTimestamps();
    }
    public function permission()
    {
        return $this->belongsToMany(AdminPermissions::class,'permission_role','role_id','permission_id')->withTimestamps();
    }
    /**
     * @param $data
     * @return mixed
     * @Author : chexihuan
     * @Date : 2019/3/19 15:04
     * 角色列表
     */
    public function roleList($data)
    {
        return $this->when(isset($data['role_name']), function ($query) use ($data) {

            return $query->where('role_name', $data['role_name']);

        })
            ->paginate(15, ['id', 'role_name', 'status', 'sort', 'created_at']);
    }

    /**
     * @param $data
     * @return $this|Model
     * @Author : chexihuan
     * @Date : 2019/3/19 15:14
     * 保存
     */
    public function roleStore($data)
    {
        return $this->create($data);
    }

    /**
     * @param $id
     * @return Model|null|static
     * @Author : chexihuan
     * @Date : 2019/3/19 15:18
     * 获取角色信息
     */
    public function getRole($id)
    {
        return $this->where('id',$id)->first(['id','role_name', 'sort', 'status']);
    }

    /**
     * @param $id
     * @param $data
     * @return bool|void
     * @Author : chexihuan
     * @Date : 2019/3/19 15:41
     * 角色更新
     */
    public function roleUpdate($id,$data)
    {
        $role = $this->where('role_name', $data['role_name'])->first(['id']);

        if($role->id != $id){

            return falseAjax('角色名已存在');

        }
        return $this->where('id',$id)->update($data);
    }

    /**
     * @param $data
     * @return bool
     * @Author : chexihuan
     * @Date : 2019/3/19 15:47
     * 启用状态
     */
    public function status($data)
    {
        return $this->where('id', $data['id'])->update(['status' => $data['status']]);
    }

    public function getRule()
    {
        return $this->where('status',1)->get(['role_name','id']);
    }
}