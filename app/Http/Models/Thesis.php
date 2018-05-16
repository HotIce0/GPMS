<?php

namespace App\Http\Models;
//By Sao Guang
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Thesis extends Model
{

    protected $table = 't_thesis';
    protected $primaryKey = 'thesis_id';

    public function insertThesis($thesisVersion,$projectId,$fileOriginName){
        $this->version_number = $thesisVersion;
        $this->project_id = $projectId;
        $this->thesis_origin_name = $fileOriginName;
        $this->thesis_status = '0';
        $insertResult=$this->save();

        return $insertResult;
    }

    //获取最新论文版本号,0表示目前无论文
    public function getLastThesisVersionByProjectId($projectId){
        $thesis=$this->where('project_id',$projectId)
            ->orderBy('version_number', 'desc')
            ->first();
        $lastThesisVersion=0;
        if( $thesis!=null) $lastThesisVersion=$thesis->version_number;
        return $lastThesisVersion;
    }

}