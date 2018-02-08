<?php

namespace App\Http\Models;
//By Sao Guang
//update by LHW
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{

    protected $table = 't_student_info';

    protected $primaryKey = 'student_info_id';

    protected $fillable=['student_number','student_name','college_info_id','class_info_id','major_info_id','identity_card_number','mail_address','phone_number','qq_number','wechart_name'];

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
            self::auditCollege=> '审计学院',
        ];

        if ($ind1 !== null) {
            return array_key_exists($ind1, $arr1) ? $arr1[$ind1] : $arr1[self::computerCollege];
        }

        return $arr1;
    }




//    当向数据库中增加新的班级时，班级的名字写在这个模型
//    const nameClass = 0;  //待定义班级
    const BJClass = 1;  //计科
    const SJClass = 2;  //审计



    public function class_info_id($ind2 = null)   //班级
    {
        $arr2 = [
            //名字写这儿
//            self::nameClass => '待定义班级',
            self::BJClass => '计科17-3BJ',
            self::SJClass => '审计17-4SJ',
        ];

        if ($ind2 !== null) {
            return array_key_exists($ind2, $arr2) ? $arr2[$ind2] : $arr2[self::BJClass];
        }

        return $arr2;
    }




//    当向数据库中增加新的专业时，专业的名字写在这个模型
//    const nameMajor = 0;  //待定义专业
    const computerMajor = 1;  //计算机科学与技术
    const auditMajor = 2;   //审计学


    public function major_info_id($ind3 = null)   //专业
    {
        $arr3 = [
            //名字写这儿
//            self::nameMajor => '待定义专业',
            self::computerMajor => '计算机科学与技术',
            self::auditMajor => '审计学',
        ];

        if ($ind3 !== null) {
            return array_key_exists($ind3, $arr3) ? $arr3[$ind3] : $arr3[self::computerMajor];
        }

        return $arr3;
    }
}