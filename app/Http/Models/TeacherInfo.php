<?php

namespace App\Http\Models;
//By Sao Guang
//update by LYC
use Illuminate\Database\Eloquent\Model;

class TeacherInfo extends Model
{
    protected $table = 't_teacher_info';

    protected $primaryKey = 'teacher_info_id';

    protected $fillable = ['teacher_job_number', 'teacher_name', 'college_info_id', 'section_info_id', 'mail_address', 'phone_number', 'positional_title', 'qq_number', 'wechart_name', 'max_students'];

    public $timestamps = true;

    protected function getDateFormat()
    {
        return parent::getDateFormat();
    }

    protected function asDateTime($value)
    {
        return parent::asDateTime($value);
    }

    protected function getCollegeInfo()
    {
        return parent::belongsTo('App\Http\Models\CollegeInfo','college_info_id','college_info_id');
    }

    protected function getSectionInfo()
    {
        return parent::belongsTo('App\Http\Models\SectionInfo','section_info_id','section_info_id');
    }
//学院名称
    public function college_name($id){
        $collegename = CollegeInfo::find($id)->college_name;
        return $collegename;
    }
//教研室名称
    public function section_name($id){
        $sectionname = SectionInfo::find($id)->section_name;
        return $sectionname;
    }

}