<?php

namespace App\Http\Models;
//By Sao Guang
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    protected $table = 't_thesis';
    protected $primaryKey = 'thesis_id';

    public static function insertThesisInfo($userId,$fileNameWithPostfix){

        $user=UserBasicInfo::find($userId)
            ->first();
        $userInfo=$user->getUserInfo();
        $studentNum = $userInfo->student_number;
        $project=ProjectChoice::where('student_number',$studentNum)
            ->first();
        $projectId=$project->project_id;

        $thesis=Self::where('project_id',$projectId)
            ->count('version_number');
//            ->orderBy('version_number', 'desc')
//            ->first();
//        $thesisVersion=0;
//        if( $thesis!=null) $thesisVersion=$thesis->version_number+1;
        if($thesis==null) $thesis=210;



        return $thesis ;

    }

//    private
}