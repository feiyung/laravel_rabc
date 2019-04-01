<?php

/**
 * Created by PhpStorm.
 * User: Adminer
 * Author: chexihuan
 * Date: 2019/3/15
 * Time: 16:22
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Model
{
    protected $table = 'admin_users';
    protected $guarded = [];

    public function role()
    {
        return $this->belongsToMany(AdminRoles::class,'role_user','user_id','role_id')->withTimestamps();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * @param $data
     * @return $this|Model
     * @Author : chexihuan
     * @Date : 2019/3/18 14:45
     * 添加
     */
    public function adminStore($data)
    {
        return self::create($data);
    }

    /**
     * @param $data
     * @Author : chexihuan
     * @Date : 2019/3/18 14:45
     * 登录
     */
    public function login($data)
    {
        $info = self::where('uname', $data)->orWhere('mobile', $data)->first();

        if (!$info) {

            return falseAjax('用户不存在');

        }
        if (!$info->status) {

            return falseAjax('用户已被禁用');

        }
        $info->last_login_at = date("y-m-d H:i:s");

        $info->last_login_ip = app('request')->getClientIp();

        $check = Hash::check(request('password'), $info->password);

        if ($check) {

            $info->save();

            session(['admin_user' => $info]);

            session()->save();

            //return redirect()->intended('');

            return trueAjax('登录成功', ['url' => session()->pull('url.intended')]);

        } else {

            return falseAjax('密码错误');

        }
    }

    /**
     * @param $data
     * @return mixed
     * @Author : chexihuan
     * @Date : 2019/3/19 13:18
     * 用户列表
     */
    public function adminList($data)
    {
        return $this->when(isset($data['mobile']) && $data['mobile'], function ($query) use ($data) {

            return $query->where('mobile', $data['mobile']);

        })
            ->when(isset($data['uname']), function ($query) use ($data) {

                return $query->where('uname', $data['uname']);

            })
            ->when(isset($data['nickname']) && $data['nickname'], function ($query) use ($data) {

                return $query->where('nickname', $data['nickname']);

            })
            ->paginate(15, ['id', 'uname', 'status', 'last_login_at', 'last_login_ip', 'created_at', 'mobile', 'nickname']);
    }

    /**
     * @param $data
     * @return bool
     * @Author : chexihuan
     * @Date : 2019/3/19 13:19
     * 用户启用状态
     */
    public function status($data)
    {
        return $this->where('id', $data['id'])->update(['status' => $data['status']]);
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     * @Author : chexihuan
     * @Date : 2019/3/19 13:22
     * 更新
     */
    public function adminUpdate($id,$data)
    {
        $uname = $this->where('uname', $data['uname'])->first(['id']);

        $mobile = $this->orWhere('mobile', $data['mobile'])->first(['id']);

        if($uname->id != $id){

            return falseAjax('用户名已存在');

        }elseif($mobile->id != $id){

            return falseAjax('手机号已存在');

        }
        if(isset($data['password'])){

            $data['password'] = bcrypt($data['password']);

        }
        return $this->where('id',$id)->update($data);
    }

    public function getInfo($id)
    {
        return $this->where('id',$id)->first(['id','uname', 'nickname', 'password', 'mobile', 'status']);
    }

}