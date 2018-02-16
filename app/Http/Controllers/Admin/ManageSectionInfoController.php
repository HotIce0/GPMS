<?php
//by xiaoming
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ManageSectionInfoController extends Controller
{
    public function sectionInfo()//教研室信息管理
    {
        return view('admin.manageInfo.Section.Section');
    }

}