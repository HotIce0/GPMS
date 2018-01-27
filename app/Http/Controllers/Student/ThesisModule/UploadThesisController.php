<?php

//by tan folder ThesisModule
//TODO 设置个人上传文件总大小上限?

namespace App\Http\Controllers\Student\ThesisModule;

use App\Http\Controllers\Controller;
use App\Http\Models\Role;
use App\Http\Models\Thesis;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UploadThesisController extends Controller
{
    public function index()
    {
        return view('student.uploadThesis');
    }

    public function store(Request $request)
    {
        $user =Auth::user();
        $id=Auth::id();
        $file=$request->file('thesis');

        //TODO
        if(Auth::user()->can('permission','2.1')){
            exit('学生有2.1权限！');
        }

        return Thesis::insertThesisInfo($id,'a');

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

        if(self::saveThesisToServer($file,$id)){
            return  back()->with('success','保存成功');
        }
        else{
            return  back()->withErrors( '保存失败请重试');
        }
    }

        private static function saveThesisToServer($file,$id)
        {
            $fileName=Hash::make($file);                        //哈希值作为文件名
            $fileName=str_replace('/','',$fileName);
            $filePostfix=$file->getClientOriginalExtension();

            $fileNameWithPostfix=$fileName.'.'.$filePostfix;
            $savePath='thesis/'.$id.'/'.$fileNameWithPostfix; //存放路径为thesis/{id}/{哈希值}.{后缀名}

            $content=file_get_contents($file->getRealPath());

            if(Storage::exists($savePath)) return false;



            Storage::put($savePath,$content);
            return Storage::exists($savePath);
        }
}
