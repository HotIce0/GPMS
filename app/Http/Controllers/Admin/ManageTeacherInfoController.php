<?php
//By LHW
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\TeacherInfo;

class ManageTeacherInfoController extends Controller
{
    //教师信息列表页
    public function teacherInfo()
    {
        $teacherInfos=TeacherInfo::paginate(2);

        return view('admin.manageInfo.teacher.teacher',[
            'teacherInfos'=>$teacherInfos,
        ]);
    }

    //教师信息新增页
    public function teacherInfoCreate()
    {
        return view('admin.manageInfo.teacher.create');
    }
}