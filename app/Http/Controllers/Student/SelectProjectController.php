<?php
//By Sao Guang

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Models\ItemSetInfo;
use App\Http\Models\ProjectChoice;
use App\Http\Models\Role;
use App\Http\Models\TeacherInfo;
use App\Http\Models\UserBasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SelectProjectController extends Controller
{
    /*
     * 选题页面
     */
    public function index(Request $request)
    {
        //2.4是选题权限
        if(!Auth::user()->can('permission', '2.4'))
            return response()->view('errors.503');
        $data = array();
        //获取行数参数
        $pageNum = null;
        if($request->has('selectPages'))
            Session::put('selectPages', $request->selectPages > 0 ? $request->selectPages : 10);
        if(Session::has('selectPages'))
            $pageNum = Session::get('selectPages', 10);
        else
            Session::put('selectPages', 10);
        //本届本学院的所有学校审查通过的选题
        $data['projects'] = DB::table('t_teacher_info')
            ->join(
                't_project_choice',
                't_teacher_info.teacher_job_number',
                '=',
                't_project_choice.teacher_job_number')
            ->where('college_info_id', $request->user()->getUserInfo()->college_info_id)
            ->where('session_id', ItemSetInfo::getCurrentSessionItemSetObj()->item_content_id)
            ->where('project_declaration_status', '5')                       //课题申报状态为5学校审查通过
            ->paginate($pageNum);
        //获取选项编号
        $projectTypes = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_TYPE'))->get();
        $projectOrigins = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_ORIGIN'))->get();
        //编号转化为文字
        foreach ($projectTypes as $projectType)
            $data['projectTypes'][$projectType->item_content_id] = $projectType;
        foreach ($projectOrigins as $projectOrigin)
            $data['projectOrigins'][$projectOrigin->item_content_id] = $projectOrigin;

        return view('student.selectProject.selectProject',[
            'data' => $data,
        ]);
    }

    /**
     * 选择(申请)课题
     */
    public function selectProject(Request $request, $id)
    {
        //2.4是选题权限
        if(!Auth::user()->can('permission', '2.4'))
            return response()->view('errors.503');

        $project = ProjectChoice::find($id);
        if($project == null)
            return response()->view('errors.503');
        //课题必须为0未被选状态 5学校审查通过状态
        if($project->project_choice_status != 0 || $project->project_declaration_status != 5)
            return response()->view('errors.503');
        //判断此题，用户是否已申请(页面会控制，但是也防止是刷新)
        if(count(ProjectChoice::where('student_number', $request->user()->getUserInfo()->student_number)
                ->where('teacher_job_number', $project->teacher_job_number)
                ->where('project_name', $project->project_name)
                ->get()) > 0)
            return response()->view('errors.503');
        //新建一个选题
        $newProject = new ProjectChoice();
        $newProject->project_name = $project->project_name;
        $newProject->project_type = $project->project_type;
        $newProject->project_origin = $project->project_origin;
        $newProject->require_for_student = $project->require_for_student;
        $newProject->project_declaration_status = $project->project_declaration_status;
        $newProject->project_choice_status = 1;                             //课题被选状态1 已被选
        $newProject->session_id = $project->session_id;
        $newProject->teacher_job_number = $project->teacher_job_number;
        $newProject->student_number = $request->user()->getUserInfo()->student_number;
        if($newProject->save())
            return redirect()->back()->with('successMsg', '题目申请成功!');
        else
            return response()->view('errors.503');
    }
}