<?php
//By LHW
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\CollegeInfo;
use App\Http\Models\MajorInfo;
use Illuminate\Http\Request;

class ManageMajorInfoController extends Controller
{
    //专业信息列表页
    public function majorInfo(Request $request)
    {
        $date1 = CollegeInfo::get();

        //条件筛选
//        $majorInfos=MajorInfo::where('college_info_id','1')->paginate(5);
        if ($request->has('major_identifier')){
            $majorInfos=MajorInfo::where('major_identifier',$request->input('major_identifier'))->paginate(5);
        }else if ($request->has('major_name')) {
            $majorInfos = MajorInfo::where('major_name', $request->input('major_name'))->paginate(5);
        }else if ($request->has('college_info_id')) {
            $majorInfos = MajorInfo::where('college_info_id', $request->input('college_info_id'))->paginate(500);
        }else {
            $majorInfos = MajorInfo::paginate(5);
        }

        return view('admin.manageInfo.major.major',[
            'majorInfos'=>$majorInfos,
            'date1'=>$date1,
        ]);
    }

    //专业信息新增页
    public function majorInfoCreate(Request $request)
    {
        $majorInfo=new MajorInfo();

        //获取数据库中其他表的数据
        $date1 = CollegeInfo::get();

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
                return redirect('admin/manageInfo/Major')->with('successMsg','添加成功！'.'添加的专业名称为：'.$majorInfo->major_name);
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
            'date1'=>$date1,
        ]);
    }

    //专业信息修改页面
    public function majorInfoUpdate(Request $request,$id)
    {
        $majorInfo=MajorInfo::find($id);

        //获取数据库中其他表的数据
        $date1 = CollegeInfo::get();

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
                return redirect('admin/manageInfo/Major')->with('successMsg','修改成功！'.'修改的专业名称为：'.$majorInfo->major_name);
            }else{
                return redirect()->back()->with('failureMsg','修改失败！');
            }
        }

        return view('admin.manageInfo.major.update',[
            'majorInfo'=>$majorInfo,
            'date1'=>$date1,
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
            return redirect('admin/manageInfo/Major')->with('successMsg','删除成功！'.'删除的专业名称为：'.$majorInfo->major_name);
        }else{
            return redirect()->back()->with('failureMsg','删除失败！');
        }
    }

    //专业信息回收页面
    public function majorInfoRecyclePage()
    {
        $majorInfos = MajorInfo::onlyTrashed()->paginate(2);

        return view('admin.manageInfo.major.recycle',[
            'majorInfos'=>$majorInfos,
        ]);
    }

    //专业信息回收
    public function majorInfoRecycle($id)
    {
        $majorInfo = MajorInfo::withTrashed()->find($id);
        if ($majorInfo->restore()){
            return redirect('admin/manageInfo/majorRecyclePage')->with('successMsg','回收成功！'.'回收的专业名称为：'.$majorInfo->major_name);
        }else{
            return redirect()->back()->with('failureMsg','回收失败！');
        }
    }

    //专业信息全部回收
    public function majorInfoRecycleAll()
    {
        if (MajorInfo::withTrashed()->restore()){
            return redirect('admin/manageInfo/Major')->with('successMsg','全部回收成功！');
        }else{
            return redirect()->back()->with('failureMsg','全部回收失败！');
        }
    }

    //专业信息彻底删除
    public function majorInfoRemove($id)
    {
        $majorInfo = MajorInfo::withTrashed()->find($id);
        if ($majorInfo->forceDelete()){
            return redirect('admin/manageInfo/majorRecyclePage')->with('successMsg','彻底删除成功！'.'彻底删除的专业名称为：'.$majorInfo->major_name);
        }else{
            return redirect()->back()->with('failureMsg','彻底删除失败！');
        }
    }

    //专业信息全部彻底删除
    public function majorInfoRemoveAll()
    {
        if (MajorInfo::onlyTrashed()->forceDelete()){
            return redirect('admin/manageInfo/Major')->with('successMsg','全部彻底删除成功！');
        }else{
            return redirect()->back()->with('failureMsg','全部彻底删除失败！');
        }
    }

}