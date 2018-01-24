<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//直接跳转到主页
Route::get('/', function () {
    return redirect('/home');
});
// 用户登陆认证路由
$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout');

//主页
Route::get('/home', 'HomeController@index');

//需用户认证的路由
Route::Group(['middleware'=>'auth'],function() {
    /************
     * 学生路由 *
     ***********/
    Route::get('/student', 'Student\StudentIndexController@index');
    //选题模块[选题]      By Sao Guang
    /*选择课题页面(权限编号2.4)*/
    Route::get('/selectProject', 'Student\SelectProjectController@index');
    Route::get('/select/{id}', 'Student\SelectProjectController@selectProject');
    Route::get('/cancelSelect/{id}', 'Student\SelectProjectController@cancelSelect');
    /************
     * 教师路由 *
     ***********/
    Route::get('/teacher', 'Teacher\TeacherIndexController@index');
    //选题模块[出题，审题] By Sao Guang
    Route::Group(['prefix' => 'createProject'], function (){
        /*出题申请(权限编号2.1)*/
        Route::get('projectChecklist/{id?}', 'Teacher\ProjectChecklistController@index');
        Route::post('projectChecklist', 'Teacher\ProjectChecklistController@saveChecklist');
        Route::get('getStudentInfoByName', 'Teacher\ProjectChecklistController@getStudentInfoByName');
        /*题目审查(学院级别权限编号2.2)*/
        Route::get('checkProject', 'Teacher\CheckProjectController@index');
        Route::post('adoptProjects', 'Teacher\CheckProjectController@adoptSelectedProjects');
        Route::get('checkProjectDetail/{id}', 'Teacher\CheckProjectController@checkProjectIndex');
        Route::post('rejectProject', 'Teacher\CheckProjectController@rejectProject');
        /*题目审查(学校级别权限编号2.3)*/
        Route::get('checkProjectSchool', 'Teacher\CheckProjectSchoolController@index');
        Route::post('adoptProjectsSchool', 'Teacher\CheckProjectSchoolController@adoptSelectedProjects');
        Route::get('checkProjectDetailSchool/{id}', 'Teacher\CheckProjectSchoolController@checkProjectIndex');
        Route::post('rejectProjectSchool', 'Teacher\CheckProjectSchoolController@rejectProject');
        /*管理选题(教师查看选题申请的权限编号2.5)*/
        Route::get('ManageProjects', 'Teacher\ManageProjectsController@index');
        Route::get('deleteProject/{id}', 'Teacher\ManageProjectsController@deleteProejct');
        Route::get('cancelProjectApplication/{id}', 'Teacher\ManageProjectsController@cancelProjectApplication');
        Route::get('confirmStudentProjectApplication/{id}', 'Teacher\ManageProjectsController@confirmStudentProjectApplication');
        Route::get('rejectStudentProjectApplication/{id}', 'Teacher\ManageProjectsController@rejectStudentProjectApplication');
        /*管理任务书(教师查看任务书的权限编号2.10)*/
        Route::get('manageAssignmentBook', 'Teacher\ReleaseAssignmentBookController@index');
    });

    /**************
     * 管理员路由 *
     *************/
    Route::get('/admin', 'Admin\AdminIndexController@index');
});


//-----------------------测试路由

//权限测试 By Sao Guang
Route::get('/setPermission', function (){
    dd( \App\Http\Models\Role::find(1)
        ->first()
        ->setPermission('1.1'));
});