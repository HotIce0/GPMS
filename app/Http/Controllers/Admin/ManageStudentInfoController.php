<?php
//By LHW
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\ClassInfo;
use App\Http\Models\CollegeInfo;
use App\Http\Models\MajorInfo;
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

        //获取数据库中其他表的数据
        $date1 = CollegeInfo::get();
        $date2 = ClassInfo::get();
        $date3 = MajorInfo::get();

        if ($request->isMethod('POST')){

            $validator=\Validator::make($request->input(),[
                'StudentInfo.student_number'=>'required|unique:t_student_info,student_number|integer|min:10000000000|max:99999999999',  //学号
                'StudentInfo.student_name'=>'required|min:2|max:20',                                                                    //姓名
                'StudentInfo.college_info_id'=>'required|integer',                                                                      //学院
                'StudentInfo.class_info_id'=>'required|integer',                                                                        //班级
                'StudentInfo.major_info_id'=>'required|integer',                                                                        //专业
                'StudentInfo.identity_card_number'=>'required|unique:t_student_info,identity_card_number|identitycards',                //身份证号码
                'StudentInfo.mail_address'=>'required|email|unique:t_student_info,mail_address',                                        //邮箱地址
                'StudentInfo.phone_number'=>'required|unique:t_student_info,phone_number|integer|min:10000000000|max:99999999999',      //电话号码
                'StudentInfo.qq_number'=>'required|unique:t_student_info,qq_number|integer|min:100000|max:99999999999',                 //QQ号
                'StudentInfo.wechart_name'=>'required|unique:t_student_info,wechart_name',                                              //微信号
            ],[
                'required'=>':attribute 必须填写！',
                'min'=>':attribute 长度太短！',
                'max'=>':attribute 长度太长！',
                'integer'=>'必须为整数！',
                'unique'=>'该项信息已经存在！',
                'email'=>'请输入正确的邮箱地址！',
            ],[
                'StudentInfo.student_number'=>'学号',
                'StudentInfo.student_name'=>'学生名称',
                'StudentInfo.college_info_id'=>'所属学院',
                'StudentInfo.class_info_id'=>'所属班级',
                'StudentInfo.major_info_id'=>'所属专业',
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
                return redirect('manageInfo/Student')->with('successMsg','添加成功！'.'添加的学生学号为：'.$studentInfo->student_number);
            }else{
                return redirect()->back()->with('failureMsg','添加失败！');
            }

//            if (StudentInfo::create($data)){
//                return redirect('manageInfo/Student')->with('successMsg','添加成功！');
//            }else{
//                return redirect()->back()->with('failureMsg','添加失败！');
//            }
        }

        return view('admin.manageInfo.student.create',[
            'studentInfo'=>$studentInfo,
            'date1'=>$date1,
            'date2'=>$date2,
            'date3'=>$date3,
        ]);
    }

    //学生信息修改页面
    public function studentInfoUpdate(Request $request,$id)
    {
        $studentInfo=StudentInfo::find($id);

        //获取数据库中其他表的数据
        $date1 = CollegeInfo::get();
        $date2 = ClassInfo::get();
        $date3 = MajorInfo::get();

        if ($request->isMethod('POST')){

            $validator=\Validator::make($request->input(),[
                'StudentInfo.student_number'=>'required|integer|min:10000000000|max:99999999999|unique:t_student_info,student_number,'.$studentInfo->student_info_id.',student_info_id',//学号
                'StudentInfo.student_name'=>'required|min:2|max:20',                                                                                                                    //姓名
                'StudentInfo.college_info_id'=>'required|integer',                                                                                                                      //学院
                'StudentInfo.class_info_id'=>'required|integer',                                                                                                                        //班级
                'StudentInfo.major_info_id'=>'required|integer',                                                                                                                        //专业
                'StudentInfo.identity_card_number'=>'required|identitycards|unique:t_student_info,identity_card_number,'.$studentInfo->student_info_id.',student_info_id',              //身份证号码
                'StudentInfo.mail_address'=>'required|email|unique:t_student_info,mail_address,'.$studentInfo->student_info_id.',student_info_id',                                      //邮箱地址
                'StudentInfo.phone_number'=>'required|integer|min:10000000000|max:99999999999|unique:t_student_info,phone_number,'.$studentInfo->student_info_id.',student_info_id',    //电话号码
                'StudentInfo.qq_number'=>'required|integer|min:100000|max:99999999999|unique:t_student_info,qq_number,'.$studentInfo->student_info_id.',student_info_id',               //QQ号
                'StudentInfo.wechart_name'=>'required|unique:t_student_info,wechart_name,'.$studentInfo->student_info_id.',student_info_id',                                            //微信号
            ],[
                'required'=>':attribute 必须填写！',
                'min'=>':attribute 长度太短！',
                'max'=>':attribute 长度太长！',
                'integer'=>'必须为整数！',
                'unique'=>'该项信息已经存在！',
                'email'=>'请输入正确的邮箱地址！',
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
            'date1'=>$date1,
            'date2'=>$date2,
            'date3'=>$date3,
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