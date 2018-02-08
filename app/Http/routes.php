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
    Route::group(['prefix' => 'student'], function () {
        Route::get('/', 'Student\StudentIndexController@index');

        //选题模块[选题]      By Sao Guang
        /*选择课题页面(权限编号2.4)*/
        Route::get('/selectProject', 'Student\SelectProjectController@index');
        Route::get('/select/{id}', 'Student\SelectProjectController@selectProject');
        Route::get('/cancelSelect/{id}', 'Student\SelectProjectController@cancelSelect');

        //开题模块     By xcc
        Route::get('/open','Student\StudentIndexController@open');
        Route::post('/student/open','Student\StudentIndexController@submit');
        Route::get('/my_opening','Student\StudentIndexController@my_opening');
        Route::get('/open_looking/{opening_report_id}/{project_id}','Student\StudentIndexController@open_looking');
        Route::get('/open_delete/{opening_report_id}','Student\StudentIndexController@open_delete');

        //by tan
        Route::get('/uploadThesis','Student\ThesisModule\UploadThesisController@index');
        Route::post('/uploadThesis','Student\ThesisModule\UploadThesisController@store');
    });

    /************
     * 教师路由 *
     ***********/
    Route::group(['prefix' => 'teacher'], function () {
        Route::get('/', 'Teacher\TeacherIndexController@index');

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


    });
    //开题模块      By xcc
    Route::get('/student_opening','Teacher\TeacherIndexController@student_opening');
    Route::get('/teacher/review/{opening_report_id}/{project_id}','Teacher\TeacherIndexController@opening_review');
    Route::post('/teacher/review','Teacher\TeacherIndexController@submit');
    /**************
     * 管理员路由 *
     *************/
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Admin\AdminIndexController@index');
    });
    Route::get('/summary','Admin\AdminIndexController@summary');
    //信息管理路由群，by xiaoming
    Route::Group(['prefix' => 'manageInfo'], function (){
        // 教师信息管理
        Route::get('Teacher', 'Admin\ManageTeacherInfoController@teacherInfo');//主页信息浏览
        Route::any('teacherUpdate/{id}', 'Admin\ManageTeacherInfoController@teacherInfoUpdate');//修改
        Route::any('teacherCreate', 'Admin\ManageTeacherInfoController@teacherInfoCreate');//新增
        Route::any('teacherDetail/{id}', 'Admin\ManageTeacherInfoController@teacherInfoDetail');//详情
        Route::any('teacherDelete/{id}', 'Admin\ManageTeacherInfoController@teacherInfoDelete');//删除

        // 学生信息管理
        Route::get('Student', 'Admin\ManageStudentInfoController@studentInfo');//主页信息浏览
        Route::any('studentUpdate/{id}', 'Admin\ManageStudentInfoController@studentInfoUpdate');//修改
        Route::any('studentCreate', 'Admin\ManageStudentInfoController@studentInfoCreate');//新增
        Route::any('studentDetail/{id}', 'Admin\ManageStudentInfoController@studentInfoDetail');//详情
        Route::any('studentDelete/{id}', 'Admin\ManageStudentInfoController@studentInfoDelete');//删除

        // 班级信息管理
        Route::get('Class', 'Admin\ManageClassInfoController@classInfo');//主页信息浏览
        Route::any('classUpdate/{id}', 'Admin\ManageClassInfoController@classInfoUpdate');//修改
        Route::any('classCreate', 'Admin\ManageClassInfoController@classInfoCreate');//新增
        Route::get('classDelete/{id}', 'Admin\ManageClassInfoController@classInfoDelete');//删除

        // 专业信息管理
        Route::get('Major', 'Admin\ManageMajorInfoController@majorInfo');//主页信息浏览
        Route::any('majorUpdate/{id}', 'Admin\ManageMajorInfoController@majorInfoUpdate');//修改
        Route::any('majorCreate', 'Admin\ManageMajorInfoController@majorInfoCreate');//新增
        Route::any('majorDetail/{id}', 'Admin\ManageMajorInfoController@majorInfoDetail');//详情
        Route::any('majorDelete/{id}', 'Admin\ManageMajorInfoController@majorInfoDelete');//删除

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

//页面测试 By xcc
Route::get('/test',function (){
    return view('student.index');
});
