<?php
//By LHW
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\StudentInfo;

class ManageStudentInfoController extends Controller
{
    //学生列表页
    public function studentInfo()
    {
        $studentInfos=StudentInfo::paginate(2);

        return view('admin.manageInfo.student.student',[
            'studentInfos'=>$studentInfos,
        ]);
    }

    public function studentInfoCreate()
    {
        return view('admin.manageInfo.student.create');
    }

}