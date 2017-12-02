<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTStudentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_student_info', function (Blueprint $table) {
            $table->increments('student_info_id');
            $table->string('student_number', 30)->unique()->comment('学号');
            $table->string('student_name', 20)->comment('学生名称');
            $table->integer('college_info_id')->unsigned()->comment('所属学院');                //外键
            $table->integer('class_info_id')->unsigned()->comment('所属班级');                  //外键
            $table->integer('major_info_id')->unsigned()->comment('所学专业');                  //外键
            $table->string('identity_card_number', 18)->comment('身份证号码');
            $table->string('mail_address', 80)->comment('邮箱地址');
            $table->string('phone_number', 20)->comment('电话号码');
            $table->string('qq_number', 20)->comment('QQ号');
            $table->string('wechart_name', 20)->comment('微信号');

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
        Schema::drop('t_student_info');
    }
}
