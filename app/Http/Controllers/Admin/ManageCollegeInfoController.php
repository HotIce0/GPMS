<?php
//by xiaoming
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Models\CollegeInfo;
use Illuminate\Http\Request;

class ManageCollegeInfoController extends Controller
{
    public function collegeInfo()//学院信息管理
    {
        $collegeInfos=CollegeInfo::paginate(10);

        return view('admin.manageInfo.college.college',[
            'collegeInfos' => $collegeInfos,
        ]);
    }

    public function collegeInfoUpdate()//修改信息
    {
        return '修改信息';
    }

    public function collegeInfoCreate(Request $request)// 新增信息          //    错误信息提示有待于完成
    {
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
                return redirect('/admin/manageInfo/college')->with('success', '添加成功!');
            } else {
                return redirect()->back();
            }
        }

        return view('admin.manageInfo.college.create', [
            'collegeInfo' => $collegeInfo,
        ]);

    }

    public function collegeInfoDelete($id)//删除信息
    {
        $collegeInfo=CollegeInfo::find($id);

        if($collegeInfo->delete()){
            return redirect('/admin/manageInfo/college')->with('success', '删除成功!-'.$id);
        }else {
            return redirect('/admin/manageInfo/college')->with('error', '删除成功!-'.$id);
        }
    }

}