<?php
//By Sao Guang 2017.11.24
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTUsersBasicInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_users_basic_info', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_job_id', 255)->unique()->comment('学号/工号');
            $table->string('email', 255)->unique();
            $table->string('user_name', 255);
            $table->string('password', 255);
            $table->integer('role_id')->unsigned();                                             //外键约束
            $table->integer('user_type')->unsigned()->comment('0为学生，1为老师');
            $table->integer('user_info_id')->unique()->unsigned()->comment('学生信息表或教师信息表的ID');

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
        Schema::drop('t_users_basic_info');
    }
}
