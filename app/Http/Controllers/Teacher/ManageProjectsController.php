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

class ManageProjectsController extends Controller
{
    /*
     * 我的选题状态页面
     */
    public function index(Request $request)
    {
        //2.5是教师查看选题申请的权限
        if(!Auth::user()->can('permission', '2.5'))
            return response()->view('errors.503');
        $data = array();
        //获取该教师该届全部选题
        $data['projects'] = ProjectChoice::where('teacher_job_number', $request->user()->getUserInfo()->teacher_job_number)
            ->where('session_id', ItemSetInfo::getCurrentSessionItemSetObj()->item_content_id)
            ->get();
        //获取选项编号
        $projectTypes = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_TYPE'))->get();
        $projectOrigins = ItemSetInfo::where('item_no', config('constants.ITEM_PROJECT_ORIGIN'))->get();
        //编号转化为文字
        foreach ($projectTypes as $projectType)
            $data['projectTypes'][$projectType->item_content_id] = $projectType;
        foreach ($projectOrigins as $projectOrigin)
            $data['projectOrigins'][$projectOrigin->item_content_id] = $projectOrigin;
        return view('teacher.ManageProjects.ManageProjects',[
            'data' => $data,
        ]);
    }
    /*
     * 删除选题申请
     *
     * 选题申请状态必须为'1' 暂存状态  '4' 院部审查未通过状态 '6' 学校审查未通过状态
     */
    public function deleteProejct(Request $request, $id)
    {
        //2.6是教师操作自己的选题申请的权限
        if(!Auth::user()->can('permission', '2.6'))
            return response()->view('errors.503');
        //获取要删除的选题
        $project = ProjectChoice::find($id);
        if($project == null)
            return response()->view('errors.503');
        //如果该选题不是该教师的
        if($project->teacher_job_number != $request->user()->getUserInfo()->teacher_job_number)
            return response()->view('errors.503');
        //选题申请状态必须为'1' 暂存状态  '4' 院部审查未通过状态 '6' 学校审查未通过状态
        if($project->project_declaration_status == '1'
            or $project->project_declaration_status == '4'
            or $project->project_declaration_status == '6')
        {
            if($project->delete())
                return redirect()->back()->with('successMsg', '该条选题申请删除成功!');
            else
                return response()->view('errors.503');
        }else
            return response()->view('errors.503');
    }
    /*
     * 取消课题申请
     */
    public function cancelProjectApplication(Request $request, $id)
    {
        //2.6是教师操作自己的选题申请的权限
        if(!Auth::user()->can('permission', '2.6'))
            return response()->view('errors.503');
        //获取要取消的选题
        $project = ProjectChoice::find($id);
        if($project == null)
            return response()->view('errors.503');
        //如果该选题不是该教师的
        if($project->teacher_job_number != $request->user()->getUserInfo()->teacher_job_number)
            return response()->view('errors.503');
        //选题状态必须为  '2' 等待院部审查状态  '3' 等待学校审查状态 才能取消
        if($project->project_declaration_status == '2'
            or $project->project_declaration_status == '3')
        {
            $project->project_declaration_status = 1;
            if($project->save())
                return redirect()->back()->with('successMsg', '该条选题申请取消成功!');
            else
                return response()->view('errors.503');
        }else
            return response()->view('errors.503');
    }
}