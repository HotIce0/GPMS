<?php

namespace App\Http\Models;
//By Sao Guang
//update by LHW
use Illuminate\Database\Eloquent\Model;

class MajorInfo extends Model
{
    protected $table = 't_major_info';

    protected $primaryKey = 'major_info_id';

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