<?php

namespace App\Http\Models;
//By Sao Guang
//update by LHW
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{

    protected $table = 't_student_info';

    protected $primaryKey = 'student_info_id';

    protected $fillable=['student_number','student_name','college_info_id',
                          'class_info_id','major_info_id','identity_card_number',
                          'mail_address','phone_number','qq_number','wechart_name'
    ];

    public $timestamps = true;

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }
//专业名称
    public function major_name($id){
        $majarname = MajorInfo::find($id)->major_name;
        return $majarname;
    }
//班级名称
    public function class_name($id){
        $classname = ClassInfo::find($id)->class_name;
        return $classname;
    }
//学院名称
    public function college_name($id){
        $collegename = CollegeInfo::find($id)->college_name;
        return $collegename;
    }

}