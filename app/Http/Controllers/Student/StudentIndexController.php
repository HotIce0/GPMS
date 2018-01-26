<?php
//By Sao Guang

namespace App\Http\Controllers\Student;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Models\OpeningReport;
use App\Http\Models\ProjectChoice;
use App\Http\Models\TeacherInfo;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class StudentIndexController extends Controller
{
    public function index()
    {
        return view('student.index');
    }
    public function open()
    {
        return view('student.opening_write');
    }

    public function submit(\Illuminate\Http\Request $request)
    {
//            if(!$request->user()->hasPermission('submitOpeningReport'))
//            {
//                exit('error!');
//            }

        $o = ProjectChoice::where('project_name', $request->opening_name)->first();
//        dd($request->project_name);
        $openingreport = new OpeningReport;
////        $openingreport->project_id = 11;
        if ($o) {
            $openingreport->project_id = $o->project_id;
        } else {
            $openingreport->project_id = 1;
        }
//        //版本控制模块
//        $version = OpeningReport::where('version_number', $openingreport->project_id)->get();
//        if ($version) {
//            $openingreport->version_number =max($version->version_number)+1;
//        } else {
//            $openingreport->version_number = 1;
//        }
        $openingreport->version_number = 1;
        $openingreport->submit_date = date('y-m-d h:i:s');
        //$openingreport->teacher_view='不知道';
        //$openingreport->section_view='拉拉看了';//$openingreport->teacher_job_number='mmp1';
        $openingreport->opening_report_status = '审查中';
        $openingreport->opening_report_content1 = $request->one;
        $openingreport->opening_report_content2 = $request->two;
        $openingreport->opening_report_content3 = $request->three;
        $openingreport->opening_report_content4 = $request->four;
        $openingreport->creator = $request->user()->user_id;
       if ($openingreport->save()) {
           return redirect('/my_opening');
        }
    }
    public function my_opening()
    {
        $my = DB::table('t_opening_report')
            ->where('creator',Auth::user()->user_id)
            ->orderby("opening_report_id","desc")
            ->paginate(5);
        return view('student.my_opening', ['my' => $my]);
    }
    public function open_looking($opening_report_id,$project_id){
//        $look =DB::table('t_opening_report')->where('opening_report_id',$mine->opening_report_id);
        $look =OpeningReport::findOrFail($opening_report_id);  //查找到相应ID的那条记录
        $project =ProjectChoice::findOrFail($project_id);
        $t_num = $project->teacher_job_number;
        $t = TeacherInfo::where('teacher_job_number','=',$t_num)->first();
        return view('student.open_looking',['look'=>$look ,'project'=>$project,'t'=>$t]);
    }
    public function open_delete($opening_report_id){
        $look =OpeningReport::findOrFail($opening_report_id);
        if($look->delete()){
            return back();
        }
        else{
            return back();
        }
    }

}