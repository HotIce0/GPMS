<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManageInfoController extends Controller
{
    public function test()
    {
        return '这是个测试页面';
    }

    public function classInfo(){
        return view('admin.manageInfo.Class');
    }

    public function collegeInfo(){
        return view('admin.manageInfo.College');
    }

    public function staffRoomInfo(){
        return view('admin.manageInfo.StaffRoom');
    }

}