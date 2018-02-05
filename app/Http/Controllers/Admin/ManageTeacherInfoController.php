<?php
//By LHW
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ManageTeacherInfoController extends Controller
{
    public function teacherInfo()
    {
        return view('admin.manageInfo.teacher.teacher');
    }
}