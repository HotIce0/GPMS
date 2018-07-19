<?php
//By LYC
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\CollegeInfo;
use App\Http\Models\TeacherInfo;
use App\Http\Models\SectionInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ManageTeacherInfoController extends Controller
{
//    public function teacherInfo(Request $request)//教师信息管理
//    {
//        if ($request->has('searchTeacher')){
//            $searchTeacherNumberForm=$request->input('searchTeacher');
//            $teacherInfos=TeacherInfo::where('teacher_job_number',$request->input('searchTeacher'))-> orWhere('teacher_name',$request->input('searchTeacher'))->get();
//        }else{
//            $searchTeacherNumberForm=null;
//            $teacherInfos=TeacherInfo::all();
//            $teacherInfos=$teacherInfos->sortBy('teacher_job_number');
//        }
//
//        return view('admin.manageInfo.teacher.teacher',[
//            'teacherInfos' => $teacherInfos,
//            'searchTeacherNumberForm' => $searchTeacherNumberForm
//        ]);
//    }

    public function teacherInfo(Request $request)//教师信息管理
    {
        $teacherInfos=TeacherInfo::get();
        if ($request->has('searchTeacher')){
            $searchTeacherNumberForm=$request->input('searchTeacher');
            $teacherInfos=TeacherInfo::query()
                ->where('teacher_job_number',$request->input('searchTeacher'))
                ->orWhere('teacher_name',$request->input('searchTeacher'))
                ->paginate(6);
        }else{
            $searchTeacherNumberForm=null;
            $teacherInfos=TeacherInfo::query()->orderBy('teacher_job_number')->paginate(5);
        }

        return view('admin.manageInfo.teacher.teacher',[
            'teacherInfos'=>$teacherInfos,
            'searchTeacherNumberForm' => $searchTeacherNumberForm
        ]);
    }

    public function teacherInfoUpdate(Request $request,$id)//修改信息
    {
        //        1.5是教师信息管理权限
        if(!Auth::user()->can('permission', '1.5'))
            return response()->view('errors.503');

        $teacherInfo=TeacherInfo::find($id);//修改，所以找到对应数据
        $collegeInfos=CollegeInfo::get();//获取数据库中院校表的数据
        $sectionInfos=SectionInfo::get();//获取数据库中教研室表的数据

        if ($request->isMethod('post')) {

            //Validator类验证
            $validator = \Validator::make($request->input(), [
                'TeacherInfo.teacher_job_number' => 'required|unique:t_teacher_info,teacher_job_number|integer|min:10000000000|max:99999999999',
                'TeacherInfo.teacher_name' => 'required|min:2|max:8',
                'TeacherInfo.college_info_id' => 'required|integer',
                'TeacherInfo.phone_number'=>'required|integer|min:10000000000|max:99999999999',
            ], [
                'required' => ':attribute 必须填写！',
                'min' => ':attribute 长度过短！',
                'max' => ':attribute 长度过长！',
                'integer' => ':attribute 必须为整数',
            ], [
                'TeacherInfo.teacher_job_number' => '教师工号',
                'TeacherInfo.teacher_name' => '教师名称',
                'TeacherInfo.college_info_id' => '所属学院',
                'TeacherInfo.phone_number'=>'教师电话',
            ]);

            if ($validator->fails()) {//验证失败处理
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('TeacherInfo');//获取输入的数据

            $teacherInfo->teacher_job_number = $data['teacher_job_number'];//赋值
            $teacherInfo->teacher_name = $data['teacher_name'];
            $teacherInfo->college_info_id = $data['college_info_id'];

            if ($teacherInfo->save() ) {//保持成功与失败
                return redirect('/admin/manageInfo/teacher')->with('successMsg', '修改成功!');
            } else {
                return redirect()->back()->with('failureMsg', '修改失败!');
            }
        }
        return view('admin.manageInfo.teacher.update', [//视图
            'teacherInfo' => $teacherInfo,
            'collegeInfos'=>$collegeInfos,
            'sectionInfos'=>$sectionInfos
        ]);
    }

    public function teacherInfoCreate(Request $request)// 新增信息          //    错误信息提示有待于完成
    {
        //        1.5是教师信息管理权限
        if(!Auth::user()->can('permission', '1.5'))
            return response()->view('errors.503');

        $teacherInfo=new TeacherInfo();//新增，所以新建个模型
        $collegeInfos=CollegeInfo::get();//获取数据库中其他表的数据
        $sectionInfos=SectionInfo::get();//获取数据库中教研室表的数据

        if ($request->isMethod('post')) {

            //Validator类验证
            $validator = \Validator::make($request->input(), [
                'TeacherInfo.teacher_job_number' => 'required|unique:t_teacher_info,teacher_job_number|integer|min:10000000000|max:99999999999',//教师工号整数型，范围10000000000-99999999999（11位）
                'TeacherInfo.teacher_name' => 'required|min:2|max:8',//教师名称是2-8个字符
                'TeacherInfo.college_info_id' => 'required|integer',//教师所属学院
                'TeacherInfo.phone_number'=>'required|integer|min:10000000000|max:99999999999',//教师电话整数型，范围10000000000-99999999999（11位）
            ], [
                'required' => ':attribute 必须填写！',
                'min' => ':attribute 长度过短！',
                'max' => ':attribute 长度过长！',
                'integer' => ':attribute 必须为整数',
            ], [
                'TeacherInfo.teacher_job_number' => '教师工号',
                'TeacherInfo.teacher_name' => '教师名称',
                'TeacherInfo.college_info_id' => '所属学院',
                'TeacherInfo.phone_number'=>'教师电话',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('TeacherInfo');

            if (TeacherInfo::create($data) ) {
                return redirect('/admin/manageInfo/teacher')->with('successMsg', '添加成功!');
            } else {
                return redirect()->back()->with('failureMsg', '添加失败!');
            }
        }

        return view('admin.manageInfo.teacher.create', [
            'teacherInfo' => $teacherInfo,
            'collegeInfos'=>$collegeInfos,
            'sectionInfos'=>$sectionInfos,
        ]);

    }

    public function teacherInfoDelete($id)//删除信息
    {
        //        1.5是教师信息管理权限
        if(!Auth::user()->can('permission', '1.5'))
            return response()->view('errors.503');

        $teacherInfo=TeacherInfo::find($id);//找到要删除信息的id

        if($teacherInfo->delete()){//此处在模型中有处理，为软删除
            return redirect('/admin/manageInfo/teacher')->with('successMsg', '删除成功!-'.$id);
        }else {
            return redirect('/admin/manageInfo/teacher')->with('failureMsg', '删除成功!-'.$id);
        }
    }

    public function teacherInfoDetail($id)
    {
        //      1.5是教师信息管理权限
        if(!Auth::user()->can('permission', '1.5'))
            return response()->view('errors.503');

        $teacherInfo = TeacherInfo::find($id);//找到要查询的信息的id

        return view('admin.manageInfo.teacher.detail',[
            'teacherInfo' =>$teacherInfo,
        ]);
    }

}