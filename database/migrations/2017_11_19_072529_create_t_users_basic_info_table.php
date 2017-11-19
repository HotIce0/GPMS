<?php

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
            $table->integer('role_id')->unsigned();                                         //外键约束
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
