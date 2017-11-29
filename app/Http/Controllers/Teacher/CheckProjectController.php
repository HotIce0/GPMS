<?php
//By Sao Guang

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Models\ItemSetInfo;
use App\Http\Models\ProjectChoice;
use App\Http\Models\Role;
use App\Http\Models\TeacherInfo;
use App\Http\Models\UserBasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProjectController extends Controller
{
    /**
     * 题目审查页面
     */
    public function index(Request $request)
    {
        //2.2是审题权限
        if(!Auth::user()->can('permission', '2.2'))
            return response()->view('errors.503');
        $data = array();
        dd(ProjectChoice::join('t_tea'));
        return view('teacher.checkProject.checkProject');
    }
}