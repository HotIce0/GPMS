<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTTeacherInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_teacher_info', function (Blueprint $table) {
            $table->increments('teacher_info_id');
            $table->string('teacher_job_number', 20)->unique()->comment('教师工号');
            $table->string('teacher_name', 20)->comment('教师名称');
            $table->integer('college_info_id')->unsigned()->comment('所属学院');                //外键
            $table->integer('section_info_id')->unsigned()->comment('所属教研室');               //外键
            $table->string('mail_address', 80)->comment('邮箱地址');
            $table->string('phone_number', 20)->comment('电话号码');
            $table->string('positional_title', 10)->comment('职称');
            $table->string('qq_number', 20)->comment('QQ号');
            $table->string('wechart_name', 20)->comment('微信号');
            $table->tinyInteger('max_students')->comment('可指导最大学生数');

            $table->string('creator', 20)->nullable();
            $table->string('updater', 20)->nullable();
            $table->string('deleter', 20)->nullable();
            $table->softDeletes();
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
        Schema::drop('t_teacher_info');
    }
}
