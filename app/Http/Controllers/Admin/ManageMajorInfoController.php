<?php
//By Xin
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\MajorInfo;
use App\Http\Models\CollegeInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageMajorInfoController extends Controller
{
    //专业信息列表页
    public function majorInfo(Request $request)//专业信息管理
    {
        $collegeInfos=CollegeInfo::get();
        if ($request->has('searchMajor')){
            $searchMajorNumberForm=$request->input('searchMajor');
            $majorInfos=MajorInfo::query()
                ->where('major_identifier',$request->input('searchMajor'))
                ->orWhere('major_name',$request->input('searchMajor'))
                ->paginate(6);
        }else{
            $searchMajorNumberForm=null;
            $majorInfos=MajorInfo::query()->orderBy('major_identifier')->paginate(5);
        }

        return view('admin.manageInfo.Major.Major',[
            'majorInfos'=>$majorInfos,
            'collegeInfos'=>$collegeInfos,
            'searchMajorNumberForm' => $searchMajorNumberForm
        ]);
    }

    public function majorInfoUpdate(Request $request,$id)//修改信息
    {
        //        1.4是专业信息管理权限
        if(!Auth::user()->can('permission', '1.4'))
            return response()->view('errors.503');
        $majorInfo=MajorInfo::find($id);//修改，所以找到对应数据
        $collegeInfos=CollegeInfo::get();//获取数据库中其他表的数据

        if ($request->isMethod('post')) {
            //Validator类验证
            $validator = \Validator::make($request->input(), [
                'MajorInfo.major_identifier' => 'required|integer|unique:t_major_info,major_identifier|min:0|max:999',
                'MajorInfo.major_name' => 'required|unique:t_major_info,major_name|min:1|max:20',
                'MajorInfo.college_info_id' => 'required|integer',
            ], [
                'required' => ':attribute 必须填写！',
                'min' => ':attribute 长度过短！',
                'max' => ':attribute 长度过长！',
                'integer' => ':attribute 必须为整数',
                'unique'=>'该项信息已存在',
            ], [
                'MajorInfo.major_identifier' => '专业编号',
                'MajorInfo.major_name' => '专业名称',
                'MajorInfo.college_info_id' => '所属学院',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('MajorInfo');//获取输入的数据
            $majorInfo->major_identifier = $data['major_identifier'];//赋值
            $majorInfo->major_name = $data['major_name'];
            $majorInfo->college_info_id = $data['college_info_id'];

            if ($majorInfo->save() ) {//保存成功与失败
                return redirect('/admin/manageInfo/Major')->with('successMsg',  '修改成功!');
            } else {
                return redirect()->back()->with('failureMsg', '修改失败!');
            }
        }

        return view('admin.manageInfo.Major.update', [//视图
            'majorInfo' => $majorInfo,
            'collegeInfos'=>$collegeInfos
        ]);

    }

    public function majorInfoCreate(Request $request)// 新增信息
    {
        //        1.4是专业信息管理权限
        if(!Auth::user()->can('permission', '1.4'))
            return response()->view('errors.503');

        $majorInfo=new MajorInfo();
        $collegeInfos=CollegeInfo::get();

        if ($request->isMethod('post')) {
            //Validator类验证
            $validator = \Validator::make($request->input(), [
                'MajorInfo.major_identifier' => 'required|integer|unique:t_major_info,major_identifier|min:0|max:999',
                'MajorInfo.major_name' => 'required|unique:t_major_info,major_name|min:1|max:20',
                'MajorInfo.college_info_id' => 'required|integer',
            ], [
                'required' => ':attribute 必须填写！',
                'min' => ':attribute 长度过短！',
                'max' => ':attribute 长度过长！',
                'integer' => ':attribute 必须为整数',
            ], [
                'MajorInfo.major_identifier' => '专业编号',
                'MajorInfo.major_name' => '专业名称',
                'MajorInfo.college_info_id' => '所属学院',
                'unique'=>'该项信息已存在',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('MajorInfo');

            if (MajorInfo::create($data) ) {
                return redirect('/admin/manageInfo/Major')->with('successMsg', '添加成功!');
            } else {
                return redirect()->back()->with('failureMsg', '添加失败!');
            }
        }

        return view('admin.manageInfo.Major.create', [
            'majorInfo' => $majorInfo,
            'collegeInfos'=>$collegeInfos
        ]);

    }

    public function majorInfoDelete($id)//删除信息
    {
        //        1.4是专业信息管理权限
        if(!Auth::user()->can('permission', '1.4'))
            return response()->view('errors.503');

        $majorInfo=MajorInfo::find($id);

        if($majorInfo->delete()){
            return redirect('/admin/manageInfo/Major')->with('successMsg', '删除成功!-'.$id);
        }else {
            return redirect('/admin/manageInfo/Major')->with('failureMsg', '删除成功!-'.$id);
        }
    }
}