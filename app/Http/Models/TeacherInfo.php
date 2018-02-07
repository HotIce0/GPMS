<?php

namespace App\Http\Models;
//By Sao Guang
//update by LHW
use Illuminate\Database\Eloquent\Model;

class TeacherInfo extends Model
{
    protected $table = 't_teacher_info';

    protected $primaryKey = 'teacher_info_id';

    public $timestamps = true;

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }
}