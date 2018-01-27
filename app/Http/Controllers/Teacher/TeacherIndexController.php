<?php
//By Sao Guang

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\OpeningReport;
use App\Http\Models\ProjectChoice;
use App\Http\Models\TeacherInfo;

class TeacherIndexController extends Controller
{
    public function index()
    {
        return view('teacher.index');
    }
    public  function student_opening(){
        //只显示自己题目下的开题报告
        $s_open=DB::table('t_opening_report')
            ->join('t_project_choice','t_opening_report.project_id','=','t_project_choice.project_id')
            ->join('t_users_basic_info','t_opening_report.creator','=','t_users_basic_info.user_id')
            ->where('t_project_choice.teacher_job_number',Auth::user()->user_job_id)
            ->select('t_opening_report.*','t_users_basic_info.user_name','t_project_choice.project_name')
            ->orderby("opening_report_id","desc")
            ->paginate(5);
        return view('teacher.student_opening',['s_open' => $s_open]);
    }
    public function opening_review($opening_report_id,$project_id)
    {
//        $look =DB::table('t_opening_report')->where('opening_report_id',$mine->opening_report_id);
        $look =OpeningReport::findOrFail($opening_report_id);  //查找到相应ID的那条记录
        $project =ProjectChoice::findOrFail($project_id);
        $t_num = $project->teacher_job_number;
        $t = TeacherInfo::where('teacher_job_number','=',$t_num)->first();
        return view('teacher.review_opening',['look'=>$look ,'project'=>$project,'t'=>$t]);
    }
    public function  change_states($opening_report_id){

    }
    public function submit(\Illuminate\Http\Request $request){
        $num = DB::update('update t_opening_report set opening_report_status = ? where opening_report_id = ?',[$request->state1,$request->opening_report_id]);
        if($num)
        {
            return redirect('/student_opening');
        }
        else
        {
            return redirect('/student_opening');
        }
    }
}