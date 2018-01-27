<?php
namespace App\Http\Models;
//By Sao Guang
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 't_role';

    protected $primaryKey = 'role_id';

    /**
     * 判断此角色是否拥有$permission此权限编号
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        //解析json，权限数组
        $permissions = json_decode($this->role_permission);
        //判断是否拥有对应权限
        return in_array($permission, $permissions);
    }

    /**
     * 给角色添加一个权限
     * @param $permission
     */
    public function setPermission($permission)
    {
        //判断是否已有该权限
        if(!$this->hasPermission($permission))
        {
            //判断该权限是否在T_permission数据库中存在
            if(!empty(Permission::where('permission_no', $permission)
                ->first()))
            {
                //解析json,权限数组
                $permissions = json_decode($this->role_permission);
                //添加权限
                array_push($permissions, $permission);
                //存储json
                $this->role_permission = json_encode($permissions);
                //更新权限信息
                $this->save();
                return true;
            }
            else
            {
                return false;
            }
        }
        else
            return true;                                //权限已经存在
    }

    /**
     * 移除角色的某个权限
     * @param $permission
     */
    public function removePermission($permission)
    {
        //判断是否已有该权限
        if($this->hasPermission($permission))
        {
            //解析json,权限数组
            $permissions = json_decode($this->role_permission);
            //删除权限
            $key = array_search($permission, $permissions);
            array_splice($permissions, $key, 1);
            //存储json
            $this->role_permission = json_encode($permissions);
            //更新权限信息
            $this->save();
        }
    }
}