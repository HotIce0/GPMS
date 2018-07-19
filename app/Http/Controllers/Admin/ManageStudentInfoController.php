<?php
//By yusir
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\ClassInfo;
use App\Http\Models\CollegeInfo;
use App\Http\Models\StudentInfo;
use App\Http\Models\MajorInfo;
use Illuminate\Http\Request;


class ManageStudentInfoController extends Controller
{
    //搜索界面
    public  function studentSearch(){
        $college = CollegeInfo::get();//数据库查询所有学院信息
        $major = MajorInfo::get();//数据库查询所有专业信息
        $class = ClassInfo::get();//数据库查询所有班级信息

        return view('admin.manageInfo.student.search',[
            'college' => $college,
            'major' => $major,
            'class' => $class,
        ]);
    }

    //学生信息列表页
    public function studentInfo(Request $request)
    {
        $data = $request->input('Search');

        //根据所选条件产生切片
        if($data['college_info_id'] ==0){
            $studentInfos = StudentInfo::paginate(5);
        }else{
            if(($data['class_info_id'] !=0) && ($data['major_info_id'] != 0)){
                $studentInfos = StudentInfo::where('college_info_id',$data['college_info_id'])
                    ->where('major_info_id',$data['major_info_id'])
                    ->where('class_info_id',$data['class_info_id'])
                    ->paginate(5);
            }elseif(($data['class_info_id']==0) && ($data['major_info_id'] != 0)){
                $studentInfos = StudentInfo::where('college_info_id',$data['college_info_id'])
                    ->where('major_info_id',$data['major_info_id'])
                    ->paginate(5);
            }elseif (($data['class_info_id']!=0) && ($data['major_info_id'] == 0)){
                $studentInfos = StudentInfo::where('college_info_id',$data['college_info_id'])
                    ->where('class_info_id',$data['class_info_id'])
                    ->paginate(5);
            }else{
                $studentInfos = StudentInfo::where('college_info_id',$data['college_info_id'])
                    ->paginate(5);
            }
        }
        return view('admin.manageInfo.student.student',[
            'studentInfos' => $studentInfos,
        ]);
    }

    //学生信息新增页
    public function studentInfoCreate(Request $request)
    {
        $studentInfo = new StudentInfo();
        $college = CollegeInfo::get();//数据库查询所有学院信息
        $major = MajorInfo::get();//数据库查询所有专业信息
        $class = ClassInfo::get();//数据库查询所有班级信息
        if($request->isMethod('POST')){
            $validator = \Validator::make($request->input(),[
                'StudentInfo.student_number'=>'required|unique:t_student_info,student_number|integer|min:10000000000|max:99999999999',                           //学号
                'StudentInfo.student_name'=>'required|min:2|max:20',                                                                                             //姓名
                'StudentInfo.college_info_id'=>'required|integer',                                                                                               //学院
                'StudentInfo.class_info_id'=>'required|integer',                                                                                                 //班级
                'StudentInfo.major_info_id'=>'required|integer',                                                                                                 //专业
                'StudentInfo.identity_card_number'=>'required|unique:t_student_info,identity_card_number|integer|min:100000000000000000|max:999999999999999999', //身份证号码
                'StudentInfo.mail_address'=>'required|unique:t_student_info,mail_address',                                                                       //邮箱地址
                'StudentInfo.phone_number'=>'required|unique:t_student_info,phone_number|integer|min:10000000000|max:99999999999',                               //电话号码
                'StudentInfo.qq_number'=>'required|unique:t_student_info,qq_number|integer|min:100000|max:99999999999',                                          //QQ号
                'StudentInfo.wechart_name'=>'required|unique:t_student_info,wechart_name',                                                                       //微信号
            ],[
                'required'=>':attribute 必须填写',
                'min'=>':attribute 长度不符合要求',
                'max'=>':attribute 长度不符合要求',
                'integer'=>'必须为整数',
                'unique'=>'该项信息已经存在',
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

            if($validator->fails()){//判断是否通过验证
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = $request->input('StudentInfo');
                if(StudentInfo::create($data)){//创建数据
                    return redirect('admin/manageInfo/student')->with('successMsg','添加成功!'.'-'.$data['student_name']);
                }else{
                    return redirect()->back()->with('failureMsg','添加失败！');
                }
        }
        return view('admin.manageInfo.student.create',[
            'studentInfo' => $studentInfo,
            'college' => $college,
            'major' => $major,
            'class' => $class,
        ]);
    }

    //学生信息删除
    public function studentInfoDelete($id)
    {
        //        1.6学生删除权限
        if(!Auth::user()->can('permission', '1.6'))
            return response()->view('errors.503');

        $studentInfo = StudentInfo::find($id);
        if ($studentInfo->delete()){
            return redirect('admin/manageInfo/student')->with('successMsg','删除成功!'.'-'.$studentInfo->student_name);
        }else{
            return redirect()->back()->with('failureMsg','删除失败！');
        }
    }


    //学生信息修改页面
    public function studentInfoUpdate(Request $request,$id)
    {
        //        1.6学生信息修改权限
        if(!Auth::user()->can('permission', '1.6'))
            return response()->view('errors.503');

        $studentInfo=StudentInfo::find($id);
        $college = CollegeInfo::get();//数据库查询所有学院信息
        $major = MajorInfo::get();//数据库查询所有专业信息
        $class = ClassInfo::get();//数据库查询所有班级信息

        if ($request->isMethod('POST')){

            $validator=\Validator::make($request->input(),[
                'StudentInfo.student_number'=>'required|integer|min:10000000000|max:99999999999',                       //学号
                'StudentInfo.student_name'=>'required|min:2|max:20',                                                    //姓名
                'StudentInfo.college_info_id'=>'required|integer',                                                      //学院
                'StudentInfo.class_info_id'=>'required|integer',                                                        //班级
                'StudentInfo.major_info_id'=>'required|integer',                                                        //专业
                'StudentInfo.identity_card_number'=>'required|integer|min:100000000000000000|max:999999999999999999',   //身份证号码
                'StudentInfo.mail_address'=>'required',                                                                 //邮箱地址
                'StudentInfo.phone_number'=>'required|integer|min:10000000000|max:99999999999',                         //电话号码
                'StudentInfo.qq_number'=>'required|integer|min:100000|max:99999999999',                                 //QQ号
                'StudentInfo.wechart_name'=>'required',                                                                 //微信号
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
                return redirect('admin/manageInfo/student')->with('successMsg','修改成功！'.'修改的学生学号为：'.$studentInfo->student_name);
            }else{
                return redirect()->back()->with('failureMsg','修改失败！');
            }
        }

        return view('admin.manageInfo.student.update',[
            'studentInfo'=>$studentInfo,
            'college' => $college,
            'major' => $major,
            'class' => $class,
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


}