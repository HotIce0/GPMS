<?php
//by xiaoming
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ManageCollegeInfoController extends Controller
{
    public function collegeInfo()//学院信息管理
    {
        return view('admin.manageInfo.College');
    }

}