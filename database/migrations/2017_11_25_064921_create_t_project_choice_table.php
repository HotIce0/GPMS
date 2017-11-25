<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTProjectChoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_project_choice', function (Blueprint $table) {
            $table->increments('project_id');
            $table->string('project_name', 80)->comment('课题名称');
            $table->string('project_type', 10)->comment('课题类型');
            $table->string('project_origin', 10)->comment('课题来源');
            $table->text('require_for_student')->unllable()->comment('对学生的要求');
            $table->string('project_declaration_status', 10)->comment('课题申报状态');
            $table->string('project_choice_status', 10)->comment('课题被选状态');
            $table->string('session_id', 10)->comment('界别ID');
            $table->string('teacher_job_number', 20)->comment('出题指导老师');            //外键
            $table->string('student_number', 30)->default(0)->comment('选题学生');         //外键

            $table->string('creator', 20)->nullable();
            $table->string('updater', 20)->nullable();
            $table->string('deleter', 20)->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_project_choice');
    }
}
