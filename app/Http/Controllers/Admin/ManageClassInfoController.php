<?php
//by xiaoming
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\ClassInfo;
use App\Http\Models\CollegeInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ManageClassInfoController extends Controller
{
    public function classInfo(Request $request)//班级信息管理
    {
        if ($request->has('searchClass')){
            $searchClassNumberForm=$request->input('searchClass');
            $classInfos=ClassInfo::where('class_identifier',$request->input('searchClass'))-> orWhere('class_name',$request->input('searchClass'))->get();

        }else{
            $searchClassNumberForm=null;
            $classInfos=ClassInfo::query()->orderBy('class_identifier')->paginate(5);
        }
        return view('admin.manageInfo.class.class',[
            'classInfos' => $classInfos,
            'searchClassNumberForm' => $searchClassNumberForm
        ]);
    }

    public function classInfoUpdate(Request $request,$id)//修改信息
    {
        //        1.1是班级信息管理权限
        if(!Auth::user()->can('permission', '1.1'))
            return response()->view('errors.503');

        $classInfo=ClassInfo::find($id);//修改，所以找到对应数据
        $collegeInfos=CollegeInfo::get();//获取数据库中其他表的数据

        if ($request->isMethod('post')) {

            //Validator类验证
            $validator = \Validator::make($request->input(), [
                'ClassInfo.class_identifier' => 'required|integer|unique:t_class_info,class_identifier|min:1000|max:9999',
                'ClassInfo.class_name' => 'required|unique:t_class_info,class_name|min:8|max:8',
                'ClassInfo.college_info_id' => 'required|integer',
            ], [
                'required' => ':attribute 必须填写！',
                'min' => ':attribute 长度过短！',
                'max' => ':attribute 长度过长！',
                'integer' => ':attribute 必须为整数',
                'unique'=>'该项信息已存在',
            ], [
                'ClassInfo.class_identifier' => '班级编号',
                'ClassInfo.class_name' => '班级名称',
                'ClassInfo.college_info_id' => '所属学院',
            ]);

            if ($validator->fails()) {//验证失败处理
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('ClassInfo');//获取输入的数据

            $classInfo->class_identifier = $data['class_identifier'];//赋值
            $classInfo->class_name = $data['class_name'];
            $classInfo->college_info_id = $data['college_info_id'];

            if ($classInfo->save() ) {//保持成功与失败
                return redirect('/admin/manageInfo/class')->with('successMsg', '修改成功!');
            } else {
                return redirect()->back()->with('failureMsg', '修改失败!');
            }
        }
        return view('admin.manageInfo.class.update', [//视图
            'classInfo' => $classInfo,
            'collegeInfos'=>$collegeInfos
        ]);
    }

    public function classInfoCreate(Request $request)// 新增信息
    {
        //        1.1是班级信息管理权限
        if(!Auth::user()->can('permission', '1.1'))
            return response()->view('errors.503');

        $classInfo=new ClassInfo();//新增，所以新建个模型
        $collegeInfos=CollegeInfo::get();//获取数据库中其他表的数据

        if ($request->isMethod('post')) {

            //Validator类验证
            $validator = \Validator::make($request->input(), [
                'ClassInfo.class_identifier' => 'required|integer|unique:t_class_info,class_identifier|min:1000|max:9999',//班级编号整数型，范围1000-9999（四位）
                'ClassInfo.class_name' => 'required|unique:t_class_info,class_name|min:8|max:8',//班级名称是8个字符
                'ClassInfo.college_info_id' => 'required|integer',//班级所属学院
            ], [
                'required' => ':attribute 必须填写！',
                'min' => ':attribute 长度过短！',
                'max' => ':attribute 长度过长！',
                'integer' => ':attribute 必须为整数',
                'unique'=>'该项信息已存在',
            ], [
                'ClassInfo.class_identifier' => '班级编号',
                'ClassInfo.class_name' => '班级名称',
                'ClassInfo.college_info_id' => '所属学院',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('ClassInfo');

            if (ClassInfo::create($data) ) {
                return redirect('/admin/manageInfo/class')->with('successMsg', '添加成功!');
            } else {
                return redirect()->back()->with('failureMsg', '添加失败!');
            }
        }

        return view('admin.manageInfo.class.create', [
            'classInfo' => $classInfo,
            'collegeInfos'=>$collegeInfos
        ]);

    }

    public function classInfoDelete($id)//删除信息
    {
        //        1.1是班级信息管理权限
        if(!Auth::user()->can('permission', '1.1'))
            return response()->view('errors.503');

        $classInfo = ClassInfo::find($id);//找到要删除信息的id
        if($classInfo->delete()){
            return redirect('/admin/manageInfo/class')->with('successMsg', '删除成功!-'.$classInfo['class_name']);
        }else {
            return redirect('/admin/manageInfo/class')->with('failureMsg', '删除成功!-'.$classInfo['class_name']);
        }
    }

}