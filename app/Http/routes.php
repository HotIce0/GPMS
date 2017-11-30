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

    /************
     * 教师路由 *
     ***********/
    Route::get('/teacher', 'Teacher\TeacherIndexController@index');
    //出题模块 By Sao Guang
    Route::Group(['prefix' => 'createProject'], function (){
        /*出题申请*/
        Route::get('projectChecklist', 'Teacher\ProjectChecklistController@index');
        Route::post('projectChecklist', 'Teacher\ProjectChecklistController@saveChecklist');
        /*题目审查*/
        Route::get('checkProject', 'Teacher\CheckProjectController@index');
        Route::post('adoptProjects', 'Teacher\CheckProjectController@adoptSelectedProjects');
        Route::get('checkProjectDetail', 'Teacher\CheckProjectController@checkProjectIndex');
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