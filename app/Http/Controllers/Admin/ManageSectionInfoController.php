<?php
//by xiaoming
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Models\SectionInfo;
use Illuminate\Http\Request;

class ManageSectionInfoController extends Controller
{
    public function sectionInfo()//教研室信息管理
    {
        $sectionInfos=SectionInfo::paginate(10);

        return view('admin.manageInfo.section.section',[
            'sectionInfos' => $sectionInfos,
        ]);
    }

    public function sectionInfoUpdate()//修改信息
    {
        return '修改信息';
    }

    public function sectionInfoCreate(Request $request)// 新增信息          //    错误信息提示有待于完成
    {
        echo "新增信息";
//        $classInfo=new ClassInfo();
//        $collegeInfos=CollegeInfo::get();
//
//        if ($request->isMethod('post')) {
//
//            //Validator类验证
//            $validator = \Validator::make($request->input(), [
//                'ClassInfo.class_identifier' => 'required|integer|min:1000|max:9999',
//                'ClassInfo.class_name' => 'required|min:8|max:8',
//                'ClassInfo.college_info_id' => 'required|integer',
//            ], [
//                'required' => ':attribute 必须填写！',
//                'min' => ':attribute 长度过短！',
//                'max' => ':attribute 长度过长！',
//                'integer' => ':attribute 必须为整数',
//            ], [
//                'ClassInfo.class_identifier' => '班级编号',
//                'ClassInfo.class_name' => '班级名称',
//                'ClassInfo.college_info_id' => '所属学院',
//            ]);
//
//            if ($validator->fails()) {
//                return redirect()->back()->withErrors($validator)->withInput();
//            }
//
//            $data = $request->input('ClassInfo');
//
//            if (ClassInfo::create($data) ) {
//                return redirect('/admin/manageInfo/class')->with('success', '添加成功!');
//            } else {
//                return redirect()->back();
//            }
//        }
//
//        return view('admin.manageInfo.class.create', [
//            'classInfo' => $classInfo,
//            'collegeInfos'=>$collegeInfos
//        ]);

    }

    public function sectionInfoDelete($id)//删除信息
    {
        echo "删除信息";
//        $classInfo=ClassInfo::find($id);
//
//        if($classInfo->delete()){
//            return redirect('/admin/manageInfo/class')->with('success', '删除成功!-'.$id);
//        }else {
//            return redirect('/admin/manageInfo/class')->with('error', '删除成功!-'.$id);
//        }
    }

}