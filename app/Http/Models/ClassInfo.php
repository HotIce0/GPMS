<?php

namespace App\Http\Models;
//By Sao Guang
//update by xiaoming
use Illuminate\Database\Eloquent\Model;

class ClassInfo extends Model
{
    const unknownCollege = 0;  //未知学院
    const computerCollege = 1;  //计算机学院
    const mathCollege = 2;  //数学学院

    protected $table = 't_class_info';

    protected $primaryKey = 'class_info_id';

    protected $fillable = ['class_identifier', 'class_name', 'college_info_id'];

    public $timestamps = true;

    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($val)
    {
        return $val;
    }

    public function college_info_id($ind = null)
    {
        $arr = [
            self::unknownCollege => '未知学院',
            self::computerCollege => '计算机学院',
            self::mathCollege => '数学学院',
        ];

        if ($ind !== null) {
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::unknownCollege];
        }

        return $arr;
    }

}