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
    /*出题页面*/
    Route::get('/projectChecklist', 'Teacher\ProjectChecklistController@index');

    /**************
     * 管理员路由 *
     *************/
    Route::get('/admin', 'Admin\AdminIndexController@index');

    Route::Group(['prefix' => 'manageInfo'], function (){
        //信息管理路由群，by xiaoming

        // 教师信息管理
        Route::get('Teacher', 'Admin\ManageInfoController@test');

        // 学生信息管理
        Route::get('Student', 'Admin\ManageInfoController@test');

        // 班级信息管理
        Route::get('Class', 'Admin\ManageClassInfoController@classInfo');//主页信息浏览
        Route::any('classUpdate/{id}', 'Admin\ManageClassInfoController@classInfoUpdate');//修改
        Route::any('classCreate', 'Admin\ManageClassInfoController@classInfoCreate');//新增
        Route::get('classDelete/{id}', 'Admin\ManageClassInfoController@classInfoDelete');//删除

        // 专业信息管理
        Route::get('Major', 'Admin\ManageInfoController@test');

        // 学院信息管理
        Route::get('College', 'Admin\ManageCollegeInfoController@collegeInfo');

        // 教研室信息管理
        Route::get('StaffRoom', 'Admin\ManageStaffRoomInfoController@staffRoomInfo');
     });
});


//-----------------------测试路由

//权限测试 By Sao Guang
Route::get('/setPermission', function (){
    dd( \App\Http\Models\Role::find(1)
        ->first()
        ->setPermission('1.1'));

});