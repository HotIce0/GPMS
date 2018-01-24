<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageInfoController extends Controller
{
    public function test()
    {
        return '这是个测试页面';
    }

    public function classInfo()//班级信息管理
    {
        $classInfos=DB::table("T_class_info")->get();
//        dd($classInfo);
        return view('admin.manageInfo.Class',[
            'classInfos' => $classInfos,
        ]);
    }

    public function collegeInfo()//学院信息管理
    {
        return view('admin.manageInfo.College');
    }

    public function staffRoomInfo()//教研室信息管理
    {
        return view('admin.manageInfo.StaffRoom');
    }

}