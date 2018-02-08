<?php
//By LHW
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\MajorInfo;
use Illuminate\Http\Request;

class ManageMajorInfoController extends Controller
{
    //专业信息列表页
    public function majorInfo()
    {
        $majorInfos=MajorInfo::paginate(5);

        return view('admin.manageInfo.major.major',[
            'majorInfos'=>$majorInfos,
        ]);
    }

    //专业信息新增页
    public function majorInfoCreate(Request $request)
    {
        $majorInfo=new MajorInfo();

        if ($request->isMethod('POST')){

            $validator=\Validator::make($request->input(),[
                'MajorInfo.major_identifier'=>'required|unique:t_major_info,major_identifier|integer',    //专业编号
                'MajorInfo.major_name'=>'required|unique:t_major_info,major_name|min:2|max:30',           //专业名称
                'MajorInfo.college_info_id'=>'required|integer',                                          //所属学院
            ],[
                'required'=>':attribute 必须填写！',
                'min'=>':attribute 长度太短！',
                'max'=>':attribute 长度太长！',
                'integer'=>'必须为整数！',
                'unique'=>'该项信息已经存在！',
            ],[
                'MajorInfo.major_identifier'=>'专业编号',
                'MajorInfo.major_name'=>'专业名称',
                'MajorInfo.college_info_id'=>'所属学院',
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('MajorInfo');

            $majorInfo->major_identifier = $data['major_identifier'];
            $majorInfo->major_name = $data['major_name'];
            $majorInfo->college_info_id = $data['college_info_id'];

            if ($majorInfo->save()){
                return redirect('manageInfo/Major')->with('successMsg','添加成功！'.'添加的专业名称为：'.$majorInfo->major_name);
            }else{
                return redirect()->back()->with('failureMsg','添加失败！');
            }

//            if (MajorInfo::create($data)){
//                return redirect('majorInfo/Major')->with('successMsg','添加成功！');
//            }else{
//                return redirect()->back()->with('failureMsg','添加失败！');
//            }
        }

        return view('admin.manageInfo.major.create',[
            'majorInfo'=>$majorInfo,
        ]);
    }

    //专业信息修改页面
    public function majorInfoUpdate(Request $request,$id)
    {
        $majorInfo=MajorInfo::find($id);

        if ($request->isMethod('POST')){

            $validator=\Validator::make($request->input(),[
                'MajorInfo.major_identifier'=>'required|integer|unique:t_major_info,major_identifier,'.$majorInfo->major_info_id.',major_info_id',  //专业编号
                'MajorInfo.major_name'=>'required|min:2|max:30|unique:t_major_info,major_name,'.$majorInfo->major_info_id.',major_info_id',         //专业名称
                'MajorInfo.college_info_id'=>'required|integer',                                                                                    //所属学院
            ],[
                'required'=>':attribute 必须填写！',
                'min'=>':attribute 长度太短！',
                'max'=>':attribute 长度太长！',
                'integer'=>'必须为整数！',
                'unique'=>'该项信息已经存在！',
            ],[
                'MajorInfo.major_identifier'=>'专业编号',
                'MajorInfo.major_name'=>'专业名称',
                'MajorInfo.college_info_id'=>'所属学院',
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('MajorInfo');

            $majorInfo->major_identifier = $data['major_identifier'];
            $majorInfo->major_name = $data['major_name'];
            $majorInfo->college_info_id = $data['college_info_id'];

            if ($majorInfo->save()){
                return redirect('manageInfo/Major')->with('successMsg','修改成功！'.'修改的专业名称为：'.$majorInfo->major_name);
            }else{
                return redirect()->back()->with('failureMsg','修改失败！');
            }
        }

        return view('admin.manageInfo.major.update',[
            'majorInfo'=>$majorInfo,
        ]);
    }

    //专业信息详情页面
    public function majorInfoDetail($id)
    {
        $majorInfo = MajorInfo::find($id);

        return view('admin.manageInfo.major.detail',[
            'majorInfo' =>$majorInfo,
        ]);
    }

    //专业信息删除
    public function majorInfoDelete($id)
    {
        $majorInfo = MajorInfo::find($id);
        if ($majorInfo->delete()){
            return redirect('manageInfo/Major')->with('successMsg','删除成功！'.'删除的专业名称为：'.$majorInfo->major_name);
        }else{
            return redirect()->back()->with('failureMsg','删除失败！');
        }
    }


}