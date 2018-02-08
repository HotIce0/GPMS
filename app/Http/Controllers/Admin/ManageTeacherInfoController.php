<?php
//By LHW
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\TeacherInfo;
use Illuminate\Http\Request;

class ManageTeacherInfoController extends Controller
{
    //教师信息列表页
    public function teacherInfo()
    {
        $teacherInfos=TeacherInfo::paginate(5);

        return view('admin.manageInfo.teacher.teacher',[
            'teacherInfos'=>$teacherInfos,
        ]);
    }

    //教师信息新增页
    public function teacherInfoCreate(Request $request)
    {
        $teacherInfo=new TeacherInfo();

        if ($request->isMethod('POST')){

            $validator=\Validator::make($request->input(),[
                'TeacherInfo.teacher_job_number'=>'required|unique:t_teacher_info,teacher_job_number|integer|min:10000000000|max:99999999999',  //教师工号
                'TeacherInfo.teacher_name'=>'required|min:2|max:20',                                                                            //教师名称
                'TeacherInfo.college_info_id'=>'required|integer',                                                                              //所属学院
                'TeacherInfo.section_info_id'=>'required|integer',                                                                              //所属教研室
                'TeacherInfo.positional_title'=>'required',                                                                                     //职称
                'TeacherInfo.max_students'=>'required|integer',                                                                                 //可指导最大学生数
                'TeacherInfo.academic_degree'=>'required',                                                                                      //学位
                'TeacherInfo.mail_address'=>'required|email|unique:t_teacher_info,mail_address',                                                //邮箱地址
                'TeacherInfo.phone_number'=>'required|unique:t_teacher_info,phone_number|integer|min:10000000000|max:99999999999',              //电话号码
                'TeacherInfo.qq_number'=>'required|unique:t_teacher_info,qq_number|integer|min:100000|max:99999999999',                         //QQ号
                'TeacherInfo.wechart_name'=>'required|unique:t_teacher_info,wechart_name',                                                      //微信号
            ],[
                'required'=>':attribute 必须填写！',
                'min'=>':attribute 长度太短！',
                'max'=>':attribute 长度太长！',
                'integer'=>'必须为整数！',
                'unique'=>'该项信息已经存在！',
                'email'=>'请输入正确的邮箱地址！',
            ],[
                'TeacherInfo.teacher_job_number'=>'教师工号',
                'TeacherInfo.teacher_name'=>'教师名称',
                'TeacherInfo.college_info_id'=>'所属学院',
                'TeacherInfo.section_info_id'=>'所属教研室',
                'TeacherInfo.positional_title'=>'职称',
                'TeacherInfo.max_students'=>'可指导最大学生数',
                'TeacherInfo.academic_degree'=>'学位',
                'TeacherInfo.mail_address'=>'邮箱地址',
                'TeacherInfo.phone_number'=>'电话号码',
                'TeacherInfo.qq_number'=>'QQ号',
                'TeacherInfo.wechart_name'=>'微信号',
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('TeacherInfo');

            $teacherInfo->teacher_job_number = $data['teacher_job_number'];
            $teacherInfo->teacher_name = $data['teacher_name'];
            $teacherInfo->college_info_id = $data['college_info_id'];
            $teacherInfo->section_info_id = $data['section_info_id'];
            $teacherInfo->positional_title = $data['positional_title'];
            $teacherInfo->max_students = $data['max_students'];
            $teacherInfo->academic_degree = $data['academic_degree'];
            $teacherInfo->mail_address = $data['mail_address'];
            $teacherInfo->phone_number = $data['phone_number'];
            $teacherInfo->qq_number = $data['qq_number'];
            $teacherInfo->wechart_name = $data['wechart_name'];

            if ($teacherInfo->save()){
                return redirect('manageInfo/Teacher')->with('successMsg','添加成功！'.'添加的教师工号为：'.$teacherInfo->teacher_job_number);
            }else{
                return redirect()->back()->with('failureMsg','添加失败！');
            }

//            if (TeacherInfo::create($data)){
//                return redirect('manageInfo/Teacher')->with('successMsg','添加成功！');
//            }else{
//                return redirect()->back()->with('failureMsg','添加失败！');
//            }
        }

        return view('admin.manageInfo.teacher.create',[
            'teacherInfo'=>$teacherInfo,
        ]);
    }

    //教师信息修改页面
    public function teacherInfoUpdate(Request $request,$id)
    {
        $teacherInfo=TeacherInfo::find($id);

        if ($request->isMethod('POST')){

            $validator=\Validator::make($request->input(),[
                'TeacherInfo.teacher_job_number'=>'required|integer|min:10000000000|max:99999999999|unique:t_teacher_info,teacher_job_number,'.$teacherInfo->teacher_info_id.',teacher_info_id', //教师工号
                'TeacherInfo.teacher_name'=>'required|min:2|max:20',                                                                                                                             //教师名称
                'TeacherInfo.college_info_id'=>'required|integer',                                                                                                                               //所属学院
                'TeacherInfo.section_info_id'=>'required|integer',                                                                                                                               //所属教研室
                'TeacherInfo.positional_title'=>'required',                                                                                                                                      //职称
                'TeacherInfo.max_students'=>'required|integer',                                                                                                                                  //可指导最大学生数
                'TeacherInfo.academic_degree'=>'required',                                                                                                                                       //学位
                'TeacherInfo.mail_address'=>'required|email|unique:t_teacher_info,mail_address,'.$teacherInfo->teacher_info_id.',teacher_info_id',                                               //邮箱地址
                'TeacherInfo.phone_number'=>'required|integer|min:10000000000|max:99999999999|unique:t_teacher_info,phone_number,'.$teacherInfo->teacher_info_id.',teacher_info_id',             //电话号码
                'TeacherInfo.qq_number'=>'required|integer|min:100000|max:99999999999|unique:t_teacher_info,qq_number,'.$teacherInfo->teacher_info_id.',teacher_info_id',                        //QQ号
                'TeacherInfo.wechart_name'=>'required|unique:t_teacher_info,wechart_name,'.$teacherInfo->teacher_info_id.',teacher_info_id',                                                     //微信号
            ],[
                'required'=>':attribute 必须填写！',
                'min'=>':attribute 长度太短！',
                'max'=>':attribute 长度太长！',
                'integer'=>'必须为整数！',
                'unique'=>'该项信息已经存在！',
                'email'=>'请输入正确的邮箱地址！',
            ],[
                'TeacherInfo.teacher_job_number'=>'教师工号',
                'TeacherInfo.teacher_name'=>'教师名称',
                'TeacherInfo.college_info_id'=>'所属学院',
                'TeacherInfo.section_info_id'=>'所属教研室',
                'TeacherInfo.positional_title'=>'职称',
                'TeacherInfo.max_students'=>'可指导最大学生数',
                'TeacherInfo.academic_degree'=>'学位',
                'TeacherInfo.mail_address'=>'邮箱地址',
                'TeacherInfo.phone_number'=>'电话号码',
                'TeacherInfo.qq_number'=>'QQ号',
                'TeacherInfo.wechart_name'=>'微信号',
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('TeacherInfo');

            $teacherInfo->teacher_job_number = $data['teacher_job_number'];
            $teacherInfo->teacher_name = $data['teacher_name'];
            $teacherInfo->college_info_id = $data['college_info_id'];
            $teacherInfo->section_info_id = $data['section_info_id'];
            $teacherInfo->positional_title = $data['positional_title'];
            $teacherInfo->max_students = $data['max_students'];
            $teacherInfo->academic_degree = $data['academic_degree'];
            $teacherInfo->mail_address = $data['mail_address'];
            $teacherInfo->phone_number = $data['phone_number'];
            $teacherInfo->qq_number = $data['qq_number'];
            $teacherInfo->wechart_name = $data['wechart_name'];

            if ($teacherInfo->save()){
                return redirect('manageInfo/Teacher')->with('successMsg','修改成功！'.'修改的教师工号为：'.$teacherInfo->teacher_job_number);
            }else{
                return redirect()->back()->with('failureMsg','修改失败！');
            }
        }

        return view('admin.manageInfo.teacher.update',[
            'teacherInfo'=>$teacherInfo,
        ]);
    }

    //教师信息详情页面
    public function teacherInfoDetail($id)
    {
        $teacherInfo = TeacherInfo::find($id);

        return view('admin.manageInfo.teacher.detail',[
            'teacherInfo' =>$teacherInfo,
        ]);
    }

    //教师信息删除
    public function teacherInfoDelete($id)
    {
        $teacherInfo = TeacherInfo::find($id);
        if ($teacherInfo->delete()){
            return redirect('manageInfo/Teacher')->with('successMsg','删除成功！'.'删除的教师工号为：'.$teacherInfo->teacher_job_number);
        }else{
            return redirect()->back()->with('failureMsg','删除失败！');
        }
    }


}