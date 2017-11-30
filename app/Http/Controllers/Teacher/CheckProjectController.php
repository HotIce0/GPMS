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
        //2.2是审题权限(学院级别)
        if(!Auth::user()->can('permission', '2.2'))
            return response()->view('errors.503');
        $data = array();
        //本届本学院的所有指导教师提交的选题
        $data['projects'] = TeacherInfo::join(
            't_project_choice',
            't_teacher_info.teacher_job_number',
            '=',
            't_project_choice.teacher_job_number')
            ->get()
            ->where('session_id', ItemSetInfo::getCurrentSessionItemSetObj()->item_content_id)
            ->where('college_info_id', $request->user()->getUserInfo()->college_info_id)
            ->where('project_declaration_status', '2');                                        //课题申报状态为2指导教师提交
        //获取选项编号
        $projectTypes = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_TYPE'))->get();
        $projectOrigins = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_ORIGIN'))->get();
        //编号转化为文字
        foreach ($projectTypes as $projectType)
            $data['projectTypes'][$projectType->item_content_id] = $projectType;
        foreach ($projectOrigins as $projectOrigin)
            $data['projectOrigins'][$projectOrigin->item_content_id] = $projectOrigin;

        return view('teacher.checkProject.checkProject',[
            'data' => $data,
        ]);
    }

    public function adoptSelectedProjects(Request $request)
    {
        //2.2是审题权限(学院级别)
        if(!Auth::user()->can('permission', '2.2'))
            return response()->view('errors.503');
        //$request->get('projectCheckbox')

    }
}