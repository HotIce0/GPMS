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

class ProjectChecklistController extends Controller
{
    /**
     * 申请出题页面
     */
    public function index()
    {
        //2.1是出题权限
        if(!Auth::user()->can('permission', '2.1'))
            return response()->view('errors.503');
        $data = array();
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
            'requireForStudent'=>'required|string|max:2000',
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
        $newProjectChoice = new ProjectChoice();
        $newProjectChoice->project_name = $request->projectName;
        $newProjectChoice->project_type = $request->projectType;
        $newProjectChoice->project_origin = $request->projectOrigin;
        $newProjectChoice->require_for_student = $request->requireForStudent;
        $newProjectChoice->project_declaration_status = 1;                                             //选题申报状态1暂存状态
        $newProjectChoice->project_choice_status = 0;                                                   //选题0未被选
        $newProjectChoice->session_id = $currentSession->item_content_id;
        $newProjectChoice->teacher_job_number = $request->user()->getUserInfo()->teacher_job_number;
        $newProjectChoice->college_info_id = $request->user()->getUserInfo()->college_info_id;
        if(!$newProjectChoice->save())
            return response()->view('errors.503');
        return redirect('/teacher');
    }
}