<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkWeeklyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_work_weekly', function (Blueprint $table) {
            $table->increments('work_weekly_id')->comment('工作日志ID');
            $table->integer('project_id')->unsigned()->comment('课题ID');               //外键
            $table->integer('weekly')->unsigned()->unique()->comment('周次');
            $table->timestamp('start_date')->comment('周开始时间');
            $table->timestamp('end_date')->comment('周结束时间');
            $table->text('record')->comment('情况记录');
            $table->text('advisor_view')->comment('指导教师意见');

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
        Schema::drop('t_work_weekly');
    }
}
