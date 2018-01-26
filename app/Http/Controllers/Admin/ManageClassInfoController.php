<?php
//by xiaoming
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;;

use App\Http\Models\ClassInfo;
use Illuminate\Http\Request;

class ManageClassInfoController extends Controller
{
    public function classInfo()//班级信息管理
    {
        $classInfos=ClassInfo::paginate(10);

        return view('admin.manageInfo.Class.Class',[
            'classInfos' => $classInfos,
        ]);
    }

    public function classInfoUpdate()//修改信息
    {
        return '修改信息';
    }

    public function classInfoCreate(Request $request)// 新增信息          //    错误信息提示有待于完成
    {
        $classInfo=new ClassInfo();


        if ($request->isMethod('post')) {

            //Validator类验证
            $validator = \Validator::make($request->input(), [
                'ClassInfo.class_identifier' => 'required|integer|min:1000|max:9999',
                'ClassInfo.class_name' => 'required|min:8|max:8',
                'ClassInfo.college_info_id' => 'required|integer|min:0|max:99',
            ], [
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求（应该为4为有效数字）',
                'max' => ':attribute 长度不符合要求（应该为4为有效数字）',
                'integer' => ':attribute 必须为整数',
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
                return redirect('manageInfo/Class')->with('success', '添加成功!');
            } else {
                return redirect()->back();
            }
        }

        return view('admin.manageInfo.Class.create', [
            'classInfo' => $classInfo
        ]);

    }

    public function classInfoDelete($id)//删除信息
    {
        $classInfo=ClassInfo::find($id);
//        $classInfo->delete();
//        if($classInfo->trasher()){
//            echo "软删除成功";
//        }else{
//            echo "软删除失败";
//        }

        if($classInfo->delete()){
            return redirect('manageInfo/Class')->with('success', '删除成功!-'.$id);
        }else {
            return redirect('manageInfo/Class')->with('error', '删除成功!-'.$id);
        }
    }

}