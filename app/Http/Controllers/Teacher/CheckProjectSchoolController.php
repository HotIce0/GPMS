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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckProjectSchoolController extends Controller
{
    /**
     * 题目审查页面(学校级别)
     * $num 代表每一页显示个数
     */
    public function index(Request $request)
    {
        //2.3是审题权限(学校级别)
        if(!Auth::user()->can('permission', '2.3'))
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
        //本届本学院的所有院部审查通过的选题
        $data['projects'] = DB::table('t_teacher_info')
            ->join(
                't_project_choice',
                't_teacher_info.teacher_job_number',
                '=',
                't_project_choice.teacher_job_number')
            ->where('college_info_id', $request->user()->getUserInfo()->college_info_id)
            ->where('session_id', ItemSetInfo::getCurrentSessionItemSetObj()->item_content_id)
            ->where('project_declaration_status', '3')                       //课题申报状态为3院部审查通过
            ->paginate($pageNum);
        //获取选项编号
        $projectTypes = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_TYPE'))->get();
        $projectOrigins = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_ORIGIN'))->get();
        //编号转化为文字
        foreach ($projectTypes as $projectType)
            $data['projectTypes'][$projectType->item_content_id] = $projectType;
        foreach ($projectOrigins as $projectOrigin)
            $data['projectOrigins'][$projectOrigin->item_content_id] = $projectOrigin;

        return view('teacher.checkProject.checkProjectSchool',[
            'data' => $data,
        ]);
    }
    /**
     * 采纳选择的选题(学校级别)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function adoptSelectedProjects(Request $request)
    {
        //2.3是审题权限(学校级别)
        if(!Auth::user()->can('permission', '2.3'))
            return response()->view('errors.503');
        $projectsID = $request->get('projectCheckbox');
        if($projectsID == null)
            return redirect()->back();
        //存储错误信息
        $errorsInfo = array();
        $errorsInfo['errorsSum'] = 0;
        //变更选择的选题申请状态到    5学校审查通过
        foreach ($projectsID as $projectID)
        {
            $project = ProjectChoice::find($projectID);
            $project->project_declaration_status = 5;
            if(!$project->save())
                $errorsInfo['errorsSum']++;
        }
        if($errorsInfo['errorsSum'] != 0)
            return redirect()->back()->with('failureMsg', '总共'.count($projectsID).'条申请,其中'.$errorsInfo['errorsSum'].'条采纳失败!');
        else
            return redirect()->back()->with('successMsg', '总共'.count($projectsID).'条申请,全部采纳成功!');
    }

    /**
     * 单个选题审核页面(学校级别)
     * @param Request $request
     * @param $id 选题ID
     * @return \Illuminate\Http\Response
     */
    public function checkProjectIndex(Request $request, $id)
    {
        //2.3是审题权限(学校级别)
        if(!Auth::user()->can('permission', '2.3'))
            return response()->view('errors.503');
        $projectChoice = ProjectChoice::find($id);
        //找不到该选题
        if($projectChoice == null)
            return response()->view('errors.503');
        //选题不在3院部审查通过状态
        if($projectChoice->project_declaration_status != 3)
            return response()->view('errors.503');
        $data['projectChoice'] = $projectChoice;

        //获取选项编号
        $projectTypes = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_TYPE'))->get();
        $projectOrigins = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_ORIGIN'))->get();
        //编号转化为文字
        foreach ($projectTypes as $projectType)
            $data['projectTypes'][$projectType->item_content_id] = $projectType;
        foreach ($projectOrigins as $projectOrigin)
            $data['projectOrigins'][$projectOrigin->item_content_id] = $projectOrigin;

        return view('teacher.checkProject.checkProjectDetailSchool',[
            'data' => $data,
        ]);
    }

    /**
     * 退回选题(学校级别)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function rejectProject(Request $request)
    {
        //2.3是审题权限(学校级别)
        if(!Auth::user()->can('permission', '2.3'))
            return response()->view('errors.503');
        //验证规则
        $rules = array(
            'amendment'=>'required|string|max:2000',
        );
        //错误消息
        $message = array(
            'required'=>'必须填写',
            'amendment.max'=>'长度不能超过2000字',
            'string' => '必须为字符串',
        );
        //字段意义
        $meaning = array(
            'amendment'=>'修改意见',
        );
        //表单验证
        $this->validate($request, $rules, $message, $meaning);
        $project = ProjectChoice::find($request->projectID);
        $project->amendment = $request->amendment;
        $project->project_declaration_status = 6;                                      //选题申报状态 6 学校审查未通过
        if($project->save())
            return redirect('createProject/checkProjectSchool')->with('successMsg', '选题申请退回成功!');
        else
            return redirect('createProject/checkProjectSchool')->with('failureMsg', '选题申请退回失败!');
    }
}