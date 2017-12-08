<?php
//By Sao Guang

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Models\ItemSetInfo;
use App\Http\Models\ProjectChoice;
use App\Http\Models\Role;
use App\Http\Models\StudentInfo;
use App\Http\Models\TeacherInfo;
use App\Http\Models\UserBasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

class ProjectChecklistController extends Controller
{
    /**
     * 申请出题页面
     */
    public function index(Request $request, $id = 0)
    {
        //2.1是出题权限
        if(!Auth::user()->can('permission', '2.1'))
            return response()->view('errors.503');
        $data = array();
        //判断是否是编辑
        if($id > 0)
        {
            $project = ProjectChoice::find($id);
            //是否存在该申请记录
            if($project == null)
                return response()->view('errors.503');
            //状态是不是'1'暂存状态 '4' 院部审查未通过 '6' 学校审查未通过
            if($project->project_declaration_status != '1' && $project->project_declaration_status != '4' && $project->project_declaration_status != '6')
                return response()->view('errors.503');
            $data['project'] = $project;
        }
        //获取选项信息(课题类型和课题来源)
        $data['projectType'] = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_TYPE'))->get();
        $data['projectOrigin'] = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_ORIGIN'))->get();
        return view('teacher.projectChecklist.projectChecklist', [
                'data' => $data,
            ]);
    }

    public function saveChecklist(Request $request)
    {
        //2.1是出题权限
        if(!Auth::user()->can('permission', '2.1'))
            return response()->view('errors.503');
        //验证规则
        $rules = array(
            'projectName'=>'required |string|max:80',
            'projectType'=>'required',
            'projectOrigin'=>'required',
            'requireForStudent'=>'string|max:2000',
        );
        //错误消息
        $message = array(
            'required'=>'必须填写',
            'projectName.max'=>'长度不能超过80字',
            'requireForStudent.max'=>'长度不能超过2000字',
            'string' => '必须为字符串',
        );
        //字段意义
        $meaning = array(
            'projectName'=>'课题名称',
            'projectType'=>'课题类型',
            'projectOrigin'=>'课题来源',
            'requireForStudent'=>'对学生的要求',
        );
        //表单验证
        $this->validate($request, $rules, $message, $meaning);
        //获取最新届别设置项对象
        $currentSession = ItemSetInfo::getCurrentSessionItemSetObj();
        //存入数据库
        $newProjectChoice = null;
        //判断是创建还是编辑
        if($request->projectID == '')
        {
            //创建
            $newProjectChoice = new ProjectChoice();
        }else
        {
            //编辑
            //是否能找到该选题申请
            $project = ProjectChoice::find($request->projectID);
            if($project == null)
                return response()->view('errors.503');
            //是不是该老师的题
            if($project->teacher_job_number != $request->user()->getUserInfo()->teacher_job_number)
                return response()->view('errors.503');
            //状态是不是'1'暂存状态 '4' 院部审查未通过 '6' 学校审查未通过
            if($project->project_declaration_status != '1' && $project->project_declaration_status != '4' && $project->project_declaration_status != '6')
                return response()->view('errors.503');
            $newProjectChoice = $project;
        }
        $newProjectChoice->project_name = $request->projectName;
        $newProjectChoice->project_type = $request->projectType;
        $newProjectChoice->project_origin = $request->projectOrigin;
        $newProjectChoice->require_for_student = $request->requireForStudent;
        //判断是暂存还是提交
        if($request->reservation == '')
        {
            //提交申请
            $newProjectChoice->project_declaration_status = '2';                                         //选题申报状态2指导教师提交
        }else
        {
            //暂存
            $newProjectChoice->project_declaration_status = '1';                                         //选题申报状态1暂存
        }
        //如果存在studentSelect，代表指定了学生
        if($request->has('studentSelect'))
        {
            $newProjectChoice->project_choice_status = '1';                                                   //选题1已被选
            $newProjectChoice->student_number = $request->studentSelect;
        }
        else
            $newProjectChoice->project_choice_status = '0';                                                   //选题0未被选
        $newProjectChoice->session_id = $currentSession->item_content_id;
        $newProjectChoice->teacher_job_number = $request->user()->getUserInfo()->teacher_job_number;
        if($newProjectChoice->save()){
            //判断是暂存还是提交
            if($request->reservation == '')
                return redirect('/teacher')->with('successMsg', '选题申请表提交成功!');
            else
                return redirect('/teacher')->with('successMsg', '选题申请表暂存成功!');
        }else
            return response()->view('errors.503');
    }
    /*
     * 姓名模糊搜索学生信息。用于Select2插件
     * 返回json数组形式
     */
    public function getStudentInfoByName(Request $request)
    {
        if(!$request->has('search'))
            return null;
        $students = StudentInfo::where('college_info_id', $request->user()->getUserInfo()->college_info_id)
            ->where('student_name', 'like', '%'.$request->search.'%')
            ->select('student_number','student_name')
            ->get();
        $data = array();
        $data['results'] = array();
        if(count($students) > 0)
            foreach ($students as $student)
                array_push($data['results'], ["id" => $student->student_number, "text" => $student->student_name.'('.$student->student_number.')']);
        return json_encode($data);
    }
}