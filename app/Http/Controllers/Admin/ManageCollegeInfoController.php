<?php
//by xiaoming
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\CollegeInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageCollegeInfoController extends Controller
{
    public function collegeInfo()//学院信息管理
    {
        $collegeInfos=CollegeInfo::paginate(10);

        return view('admin.manageInfo.college.college',[
            'collegeInfos' => $collegeInfos,
        ]);
    }

    public function collegeInfoUpdate(Request $request,$id)//修改信息
    {
        //        1.2是学院信息管理权限
        if(!Auth::user()->can('permission', '1.2'))
            return response()->view('errors.503');

        $collegeInfo=CollegeInfo::find($id);//修改，所以找到对应数据

        if ($request->isMethod('post')) {

            //Validator类验证
            $validator = \Validator::make($request->input(), [
                'CollegeInfo.college_identifier' => 'required|integer|min:0|max:999',
                'CollegeInfo.college_name' => 'required|min:4|max:10',
            ], [
                'required' => ':attribute 必须填写！',
                'min' => ':attribute 长度过短！',
                'max' => ':attribute 长度过长！',
                'integer' => ':attribute 必须为整数',
            ], [
                'CollegeInfo.college_identifier' => '学院编号',
                'CollegeInfo.college_name' => '学院名称',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $data = $request->input('CollegeInfo');//获取输入的数据

            $collegeInfo->college_identifier = $data['college_identifier'];//赋值
            $collegeInfo->college_name = $data['college_name'];

            if ($collegeInfo->save() ) {//保持成功与失败
                return redirect('/admin/manageInfo/college')->with('successMsg', '修改成功!');
            } else {
                return redirect()->back()->with('failureMsg', '修改失败!');
            }
        }
        return view('admin.manageInfo.college.update', [//视图
            'collegeInfo' =>$collegeInfo,
        ]);
    }

    public function collegeInfoCreate(Request $request)// 新增信息          //    错误信息提示有待于完成
    {
        //        1.2是学院信息管理权限
        if(!Auth::user()->can('permission', '1.2'))
            return response()->view('errors.503');

        $collegeInfo=new CollegeInfo();

        if ($request->isMethod('post')) {

            //Validator类验证
            $validator = \Validator::make($request->input(), [
                'CollegeInfo.college_identifier' => 'required|integer|min:0|max:999',
                'CollegeInfo.college_name' => 'required|min:4|max:10',
            ], [
                'required' => ':attribute 必须填写！',
                'min' => ':attribute 长度过短！',
                'max' => ':attribute 长度过长！',
                'integer' => ':attribute 必须为整数',
            ], [
                'CollegeInfo.college_identifier' => '学院编号',
                'CollegeInfo.college_name' => '学院名称',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('CollegeInfo');

            if (CollegeInfo::create($data) ) {
                return redirect('/admin/manageInfo/college')->with('successMsg', '添加成功!');
            } else {
                return redirect()->back()->with('failureMsg', '添加失败!');
            }
        }

        return view('admin.manageInfo.college.create', [
            'collegeInfo' => $collegeInfo,
        ]);

    }

    public function collegeInfoDelete($id)//删除信息
    {
        //        1.2是学院信息管理权限
        if(!Auth::user()->can('permission', '1.2'))
            return response()->view('errors.503');

        $collegeInfo=CollegeInfo::find($id);

        if($collegeInfo->delete()){
            return redirect('/admin/manageInfo/college')->with('successMsg', '删除成功!-'.$id);
        }else {
            return redirect('/admin/manageInfo/college')->with('failureMsg', '删除成功!-'.$id);
        }
    }

}