<?php

//by tan folder ThesisModule
//TODO 设置个人上传文件总大小上限?

namespace App\Http\Controllers\Student\ThesisModule;

use App\Http\Controllers\Controller;
use App\Repository\Facades\ThesisLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadThesisController extends Controller
{
    public function index()
    {
        return view('student.thesisModule.uploadThesis');
    }

    public function store(Request $request)
    {
        $user =Auth::user();
        $file=$request->file('thesis');

//        //TODO
//        if(Auth::user()->can('permission','2.1')){
//            exit('学生有2.1权限！');
//        }

        //验证表单格式
        $maxFileSize=10240;
        $rule=[
            'thesis' => 'bail|required|file|mimes:doc,docx|max:'.$maxFileSize
        ];
        $messages=[
            'thesis.required' => '请先选择论文',
            'thesis.file' => '请提交word文件',
            'thesis.mimes' => '请提交word文件',
            'thesis.max' => '文件过大,请不要超过100MB'
        ];
        $this->validate($request,$rule,$messages);

        if(ThesisLogic::insertAndSaveThesis($user,$file)==false) {
            return back()->withErrors('上传失败,请重试!');
        }
        else{
            return back()->with('success','上传成功!');
        }
    }

}
