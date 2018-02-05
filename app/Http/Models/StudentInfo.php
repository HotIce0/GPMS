<?php

namespace App\Http\Models;
//By Sao Guang
//update by LHW
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    protected $table = 't_student_info';

    protected $primaryKey = 'student_info_id';

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