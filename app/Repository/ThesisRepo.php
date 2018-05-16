<?php

namespace App\Repository;

use App\Http\Models\Thesis;
use Illuminate\Support\Facades\Storage;

class ThesisRepo
{

    public function insertAndSaveThesis($user,$file){

        $Thesis = new Thesis();

        $projectId=$user->getProjectId();
        $thesisVersion=$Thesis->getLastThesisVersionByProjectId($projectId)+1;

        $filePostfix=$file->getClientOriginalExtension();
        $fileOriginName=$file->getClientOriginalName();
        $fileContent=file_get_contents($file->getRealPath());

        //存储文件
        $savePath=$this->getSavePath($thesisVersion,$projectId,$filePostfix);
        if(!$this->saveThesisFile($fileContent,$savePath)) return false;

        //插入文件信息
        $insertResult=$Thesis->insertThesis($thesisVersion,$projectId,$fileOriginName);

        //插入论文信息失败时的取消存储
        if($insertResult==false) Storage::delete($savePath);

        return $insertResult;
    }

    private function getSavePath($thesisVersion,$projectId,$filePostfix){
        $storedFileName=$thesisVersion.'.'.$filePostfix;
        $savePath='thesis/'.$projectId.'/'.$storedFileName; //存放路径为thesis/{projectId}/{版本号}.{后缀名}
        return $savePath;
    }

    private function saveThesisFile($content,$savePath)
    {
        Storage::put($savePath,$content);
        return Storage::exists($savePath);
    }

}