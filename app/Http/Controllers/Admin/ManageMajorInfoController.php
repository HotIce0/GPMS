<?php
//By LHW
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\MajorInfo;

class ManageMajorInfoController extends Controller
{
    //专业信息列表页
    public function majorInfo()
    {
        $majorInfos=MajorInfo::paginate(2);

        return view('admin.manageInfo.major.major',[
            'majorInfos'=>$majorInfos,
        ]);
    }

    //专业信息新增页
    public function majorInfoCreate()
    {
        return view('admin.manageInfo.major.create');
    }
}