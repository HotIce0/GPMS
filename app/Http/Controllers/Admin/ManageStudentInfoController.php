<?php
//By LHW
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\StudentInfo;
use Illuminate\Http\Request;

class ManageStudentInfoController extends Controller
{
    //学生信息列表页
    public function studentInfo()
    {
        $studentInfos=StudentInfo::paginate(5);

        return view('admin.manageInfo.student.student',[
            'studentInfos'=>$studentInfos,
        ]);
    }

    //学生信息新增页
    public function studentInfoCreate(Request $request)
    {
        $studentInfo=new StudentInfo();

        if ($request->isMethod('POST')){

            $validator=\Validator::make($request->input(),[             //对是否为整数的判定未解决
//                'StudentInfo.student_number'=>'required|integer|min:11|max:11',
                'StudentInfo.student_number'=>'required|min:11|max:11',
                'StudentInfo.student_name'=>'required|min:2|max:20',
                'StudentInfo.college_info_id'=>'required|integer',
                'StudentInfo.class_info_id'=>'required|integer',
                'StudentInfo.major_info_id'=>'required|integer',
//                'StudentInfo.identity_card_number'=>'required|integer|min:18|max:18',
                'StudentInfo.identity_card_number'=>'required|min:18|max:18',
                'StudentInfo.mail_address'=>'required',
//                'StudentInfo.phone_number'=>'required|integer|min:11|max:11',
                'StudentInfo.phone_number'=>'required|min:11|max:11',
//                'StudentInfo.qq_number'=>'required|integer|min:6|max:12',
                'StudentInfo.qq_number'=>'required|min:6|max:12',
                'StudentInfo.wechart_name'=>'required',
            ],[
                'required'=>':attribute 必须填写',
                'min'=>':attribute 长度不符合要求',
                'max'=>':attribute 长度不符合要求',
                'integer'=>'必须为整数',
            ],[
                'StudentInfo.student_number'=>'学号',
                'StudentInfo.student_name'=>'姓名',
                'StudentInfo.college_info_id'=>'学院',
                'StudentInfo.class_info_id'=>'班级',
                'StudentInfo.major_info_id'=>'专业',
                'StudentInfo.identity_card_number'=>'身份证号码',
                'StudentInfo.mail_address'=>'邮箱地址',
                'StudentInfo.phone_number'=>'电话号码',
                'StudentInfo.qq_number'=>'QQ号',
                'StudentInfo.wechart_name'=>'微信号',
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('StudentInfo');

            if (StudentInfo::create($data)){
                return redirect('manageInfo/Student')->with('successMsg','添加成功！');
            }else{
                return redirect()->back()->with('failureMsg','添加失败！');
            }
        }

        return view('admin.manageInfo.student.create',[
            'studentInfo'=>$studentInfo,
        ]);
    }

    //学生信息修改页面
    public function studentInfoUpdate(Request $request,$id)
    {
        $studentInfo=StudentInfo::find($id);

        if ($request->isMethod('POST')){

            $validator=\Validator::make($request->input(),[             //对是否为整数的判定未解决
//                'StudentInfo.student_number'=>'required|integer|min:11|max:11',
                'StudentInfo.student_number'=>'required|min:11|max:11',
                'StudentInfo.student_name'=>'required|min:2|max:20',
                'StudentInfo.college_info_id'=>'required|integer',
                'StudentInfo.class_info_id'=>'required|integer',
                'StudentInfo.major_info_id'=>'required|integer',
//                'StudentInfo.identity_card_number'=>'required|integer|min:18|max:18',
                'StudentInfo.identity_card_number'=>'required|min:18|max:18',
                'StudentInfo.mail_address'=>'required',
//                'StudentInfo.phone_number'=>'required|integer|min:11|max:11',
                'StudentInfo.phone_number'=>'required|min:11|max:11',
//                'StudentInfo.qq_number'=>'required|integer|min:6|max:12',
                'StudentInfo.qq_number'=>'required|min:6|max:12',
                'StudentInfo.wechart_name'=>'required',
            ],[
                'required'=>':attribute 必须填写',
                'min'=>':attribute 长度不符合要求',
                'max'=>':attribute 长度不符合要求',
                'integer'=>'必须为整数',
            ],[
                'StudentInfo.student_number'=>'学号',
                'StudentInfo.student_name'=>'姓名',
                'StudentInfo.college_info_id'=>'学院',
                'StudentInfo.class_info_id'=>'班级',
                'StudentInfo.major_info_id'=>'专业',
                'StudentInfo.identity_card_number'=>'身份证号码',
                'StudentInfo.mail_address'=>'邮箱地址',
                'StudentInfo.phone_number'=>'电话号码',
                'StudentInfo.qq_number'=>'QQ号',
                'StudentInfo.wechart_name'=>'微信号',
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('StudentInfo');
            $studentInfo->student_number = $data['student_number'];
            $studentInfo->student_name = $data['student_name'];
            $studentInfo->college_info_id = $data['college_info_id'];
            $studentInfo->class_info_id = $data['class_info_id'];
            $studentInfo->major_info_id = $data['major_info_id'];
            $studentInfo->identity_card_number = $data['identity_card_number'];
            $studentInfo->mail_address = $data['mail_address'];
            $studentInfo->phone_number = $data['phone_number'];
            $studentInfo->qq_number = $data['qq_number'];
            $studentInfo->wechart_name = $data['wechart_name'];

            if ($studentInfo->save()){
                return redirect('manageInfo/Student')->with('successMsg','修改成功！'.'修改的学生学号为：'.$studentInfo->student_number);
            }else{
                return redirect()->back()->with('failureMsg','修改失败！');
            }
        }

        return view('admin.manageInfo.student.update',[
            'studentInfo'=>$studentInfo,
        ]);
    }

    //学生信息详情页面
    public function studentInfoDetail($id)
    {
        $studentInfo = StudentInfo::find($id);

        return view('admin.manageInfo.student.detail',[
            'studentInfo' =>$studentInfo,
        ]);
    }

    //学生信息删除
    public function studentInfoDelete($id)
    {
        $studentInfo = StudentInfo::find($id);
        if ($studentInfo->delete()){
            return redirect('manageInfo/Student')->with('successMsg','删除成功！'.'删除的学生学号为：'.$studentInfo->student_number);
        }else{
            return redirect()->back()->with('failureMsg','删除失败！');
        }
    }


}