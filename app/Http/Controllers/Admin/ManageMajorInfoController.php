<?php
//By LHW
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ManageMajorInfoController extends Controller
{
    public function majorInfo()
    {
        return view('admin.manageInfo.major.major');
    }
}