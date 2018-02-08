<?php

namespace App\Http\Models;
//By Sao Guang
//update by LHW
use Illuminate\Database\Eloquent\Model;

class TeacherInfo extends Model
{

    protected $table = 't_teacher_info';

    protected $primaryKey = 'teacher_info_id';

    protected $fillable=['teacher_job_number','teacher_name','college_info_id','section_info_id','positional_title','max_students','academic_degree','mail_address','phone_number','qq_number','wechart_name'];

    public $timestamps = true;


//    protected function getDateFormat()
//    {
//        return time();
//    }
//
//    protected function asDateTime($value)
//    {
//        return $value;
//    }



    //当向数据库中增加新的学院时，学院的名字写在这个模型
    //const nameCollege = 0;  //待定义学院
    const computerCollege = 1;  //计算机学院
    const auditCollege = 2;  //审计学院


    public function college_info_id($ind1 = null)   //学院
    {
        $arr1 = [
            //名字写这儿
//            self::nameCollege => '待定义学院',
            self::computerCollege => '计算机学院',
            self::auditCollege => '审计学院',
        ];

        if ($ind1 !== null) {
            return array_key_exists($ind1, $arr1) ? $arr1[$ind1] : $arr1[self::computerCollege];
        }

        return $arr1;
    }




    //    当向数据库中增加新的教研室时，教研室的名字写在这个模型
//    const nameClass = 0;  //待定义教研室
    const rjgcSection = 1;  //软件工程教研室



    public function section_info_id($ind2 = null)   //教研室
    {
        $arr2 = [
            //名字写这儿
//            self::nameSection => '待定义教研室',
            self::rjgcSection => '软件工程教研室',
        ];

        if ($ind2 !== null) {
            return array_key_exists($ind2, $arr2) ? $arr2[$ind2] : $arr2[self::rjgcSection];
        }

        return $arr2;
    }


}