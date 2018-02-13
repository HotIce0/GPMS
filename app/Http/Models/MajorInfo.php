<?php

namespace App\Http\Models;
//By Sao Guang
//update by LHW
use Illuminate\Database\Eloquent\Model;

class MajorInfo extends Model
{
    protected $table = 't_major_info';

    protected $primaryKey = 'major_info_id';

    protected $fillable=['major_identifier','major_name','college_info_id'];

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
//    const computerCollege = 1;  //计算机学院
//    const auditCollege = 2;  //审计学院


    public function college_info_id($ind1 = null)   //学院
    {
//        $arr = [
//            //名字写这儿
////            self::nameCollege => '待定义学院',
//            self::computerCollege => '计算机学院',
//            self::auditCollege=> '审计学院',
//        ];
//
//        if ($ind !== null) {
//            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::computerCollege];
//        }
//
//        return $arr;

        $date1=CollegeInfo::get();
        foreach ($date1 as $college)
            if ($college->college_info_id == $ind1)
            {
                $arr1 = $college->college_name;
                break;
            }
        return $arr1;
    }

}
