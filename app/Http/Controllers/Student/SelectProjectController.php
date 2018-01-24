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
        if(!Session::has('selectPages'))
            Session::put('selectPages', 10);
        $pageNum = Session::get('selectPages', 10);
        //本届本学院的所有学校审查通过的选题
        $projects = DB::table('t_teacher_info')
            ->join(
                't_project_choice',
                't_teacher_info.teacher_job_number',
                '=',
                't_project_choice.teacher_job_number')
            ->where('project_choice_status', '0')                             //'0'未被选
            ->where('project_declaration_status', '5')                       //课题申报状态为5学校审查通过
            ->where('college_info_id', $request->user()->getUserInfo()->college_info_id)
            ->where('session_id', ItemSetInfo::getCurrentSessionItemSetObj()->item_content_id);
        //搜索教师的姓名
        if($request->has('teacherName')) {
            $projects->where('teacher_name', 'like', '%' . $request->teacherName . '%');
            $pageNum = count($projects->get());                                     //搜索结果全部显示
        }
        $data['projects'] = $projects->paginate($pageNum);
        //获取选项编号
        $projectTypes = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_TYPE'))->get();
        $projectOrigins = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_ORIGIN'))->get();
        //编号转化为文字
        foreach ($projectTypes as $projectType)
            $data['projectTypes'][$projectType->item_content_id] = $projectType;
        foreach ($projectOrigins as $projectOrigin)
            $data['projectOrigins'][$projectOrigin->item_content_id] = $projectOrigin;
        //$selectedProject 获取当前学生已选课题
        $selectedProject = ProjectChoice::where('student_number', $request->user()->getUserInfo()->student_number)->get();
        //$data['selected'] 是否已选课题
        if(count($selectedProject) > 0)
        {
            $data['selectedProject'] = $selectedProject[0];
            $data['selected'] = true;
            //获取教师信息
            $data['selectedProjectTeacherInfo'] = TeacherInfo::where('teacher_job_number', $data['selectedProject']->teacher_job_number)->get()[0];
        }
        else
            $data['selected'] = false;
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
        if($project->project_choice_status != '0' || $project->project_declaration_status != '5')
            return response()->view('errors.503');
        //用户是否已选题(页面会控制，但是也防止是刷新)
        if(count(ProjectChoice::where('student_number', $request->user()->getUserInfo()->student_number)
                ->get()) > 0)
            return response()->view('errors.503');
        $project->student_number = $request->user()->getUserInfo()->student_number;
        $project->project_choice_status = '1';                             //课题被选状态1 已被选
        if($project->save())
            return redirect()->back()->with('successMsg', '题目申请成功!');
        else
            return response()->view('errors.503');
    }

    /**
     * 取消选题
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function cancelSelect(Request $request, $id)
    {
        //2.4是选题权限
        if(!Auth::user()->can('permission', '2.4'))
            return response()->view('errors.503');
        $project = ProjectChoice::find($id);
        if($project == null)
            return response()->view('errors.503');
        //该题用户并没选择
        if(!($project->student_number = $request->user()->getUserInfo()->student_number))
            return response()->view('errors.503');
        if($project->project_choice_status == '1')                         //课题被选状态1 已被选
        {
            $project->student_number = '0';
            $project->project_choice_status = '0';                             //课题被选状态0 未被选
            if($project->save())
                return redirect()->back()->with('successMsg', '题目申请取消成功!');
            else
                return response()->view('errors.503');
        }else
            return response()->view('errors.503');
    }
}