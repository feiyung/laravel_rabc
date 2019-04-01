<?php
/**
 * Created by PhpStorm.
 * User: Adminer
 * Author: chexihuan
 * Date: 2019/3/15
 * Time: 16:25
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AdminPermissions extends Model
{
    protected $table = 'admin_permissions';
    protected $guarded = [];


    public function role()
    {
        return $this->belongsToMany(AdminRoles::class,'permission_role','permission_id','role_id')->withTimestamps();
    }

    public function permission()
    {
        return $this->hasMany(self::class,'pid','id');
    }
    /**
     * @param $data
     * @return $this|Model
     * @Author : chexihuan
     * @Date : 2019/3/19 16:45
     * 权限添加
     */
    public function permissioStore($data)
    {
        return $this->create($data);
    }

    public function getTopList($id=0)
    {
        return $this->where([['level', '<', 3],['id','<>',$id]])->get(['id', 'permission_name']);
    }

    public function getList($data)
    {
        $list = $this->when(isset($data['route']), function ($query) use ($data) {

            return $query->where('route', $data['route']);

        })
            ->paginate(15,['id', 'permission_name', 'route', 'is_menu', 'menu_icon', 'status', 'created_at', 'pid']);


        return $list;
        /*if(isset($data['route'])){

            return $list;
        }

        return $this->getTree($list, 0, 0);*/
    }

    public function getTree($arr, $pid, $level)
    {
        static $tree;

        foreach ($arr as $key => $val) {

            if ($val['pid'] == $pid) {

                $val['permission_name'] = '<span style="color: #d87c6f">' . str_repeat('|--', $level) . '</span>' . $val['permission_name'];

                unset($arr[$key]);

                $tree[] = $val;

                $this->getTree($arr, $val['id'], $level + 1);
            }
        }
        return $tree;
    }

    public function status($data)
    {
        return $this->where('id', $data['id'])->update(['status' => $data['status']]);
    }

    public function getInfo($id)
    {
        return $this->where('id',$id)->first([
            'permission_name',
            'route',
            'remark',
            'level',
            'pid',
            'sort',
            'status',
            'is_menu',
            'menu_icon','id']);
    }

    public function permissionUpdate($id,$data)
    {
        $uname = $this->where('permission_name', $data['permission_name'])->first(['id']);

        $mobile = $this->orWhere('route', $data['route'])->first(['id']);

        if($uname->id != $id){

            return falseAjax('权限名称已存在');

        }elseif($mobile->id != $id){

            return falseAjax('权限路由已存在');

        }
        return $this->where('id',$id)->update($data);
    }

    public function getTrueList()
    {
        return $this->where(['status'=>1,'is_menu'=>1])->get(['id','permission_name','pid']);

    }
}