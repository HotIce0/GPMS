<?php
//by xiaoming
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ManageStaffRoomInfoController extends Controller
{
    public function staffRoomInfo()//教研室信息管理
    {
        return view('admin.manageInfo.StaffRoom');
    }

}