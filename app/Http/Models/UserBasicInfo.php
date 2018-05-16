<?php

namespace App\Http\Models;
//By Sao Guang
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserBasicInfo extends Authenticatable
{
    //软删除
    use SoftDeletes;
    //指定软删除标记字段
    protected $dates = ['delete_at'];
    //指定表名
    protected $table = 't_users_basic_info';
    //指定主键
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 判断用户是否有该权限（权限编号）
     * @param string $permisson
     * @return bool
     */
    public function hasPermission($permisson)
    {
        //获取对应角色
        $role = Role::find($this->role_id);
        //判断角色是否有该权限
        return $role->hasPermission($permisson);
    }

    /**
     * 是否是该角色
     * @param $role 角色名称，在constants配置文件中存在的
     * @return bool
     */
    public function isRole($role)
    {
        return config('constants.'.$role) == $this->role_id;
    }

    /**
     * 获取用户信息模型对象
     * @return null
     */
    public function getUserInfo()
    {
        if($this->user_type == config('constants.USER_TYPE_STUDENT'))
        {
            return StudentInfo::find($this->user_info_id);
        }elseif ($this->user_type == config('constants.USER_TYPE_TEACHER'))
        {
            return TeacherInfo::find($this->user_info_id);
        }
        return null;
    }

    /**
     *by tan
     * 获取用户的课程Id号
     */
    public function getProjectId()
    {
        $userInfo=$this->getUserInfo();
        $project=null;
        if($this->user_type == config('constants.USER_TYPE_STUDENT'))
        {
            $studentNum = $userInfo->student_number;
            $project=ProjectChoice::where('student_number',$studentNum)
                ->first();
        }elseif ($this->user_type == config('constants.USER_TYPE_TEACHER'))
        {

            $teacherJobNumber = $userInfo->teacher_job_number;
            $project=ProjectChoice::where('teacher_job_number',$teacherJobNumber)
                ->first();
        }
        $projectId=$project->project_id;
        return $projectId;
    }

}