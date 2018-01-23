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

    public function Class_info(){
        return view('admin.Manage_info.Class');
    }

    public function College_info(){
        return view('admin.Manage_info.College');
    }

    public function StaffRoom_info(){
        return view('admin.Manage_info.StaffRoom');
    }

}