<?php

namespace App\Http\Models;
//By Sao Guang
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Thesis extends Model
{
    protected $table = 't_thesis';
    protected $primaryKey = 'thesis_id';


    public static function insertThesisInfo($userId){

        $thesisOriginName='';

        $user=UserBasicInfo::find($userId)
            ->first();
        $userInfo=$user->getUserInfo();
        $studentNum = $userInfo->student_number;
        $project=ProjectChoice::where('student_number',$studentNum)
            ->first();
        $projectId=$project->project_id;

        $thesis=Self::where('project_id',$projectId)
            ->orderBy('version_number', 'desc')
            ->first();
        $thesisVersion=0;
        if( $thesis!=null) $thesisVersion=$thesis->version_number+1;

        $toInsert=array(
            'version_number'=>$thesisVersion,
            'project_id'=>$projectId,
            'thesis_origin_name'=>$thesisOriginName,
            'thesis_status'=>0
        );

        $isInsertSuccess=Self::create($toInsert);

        if($isInsertSuccess==false){

            return false;
        }
        else{
            return true;
        }

        return $thesis ;

    }

//    private
}