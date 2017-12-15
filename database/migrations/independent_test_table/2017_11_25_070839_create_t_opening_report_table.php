<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTOpeningReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_opening_report', function (Blueprint $table) {
            $table->increments('opening_report_id')->comment('开题报告ID');
            $table->integer('version_number')->unsigned()->comment('版本号：每下达一次版本号加1');
            $table->integer('project_id')->unsigned()->comment('课题ID');                         //外键
            $table->timestamp('submit_date')->comment('提交日期');
            $table->text('opening_report_content1')->comment('1.综述国内外对本课题的研究动态，说明选题的依据和意义');
            $table->text('opening_report_content2')->comment('2.研究的基本内容，拟解决的问题');
            $table->text('opening_report_content3')->comment('3.研究的步骤、方法、措施及进度安排');
            $table->text('opening_report_content4')->comment('4.主要参考文献');
            $table->text('teacher_view')->comment('指导教师意见');
            $table->text('section_view')->comment('教研室意见');
            $table->string('teacher_job_number', 20)->comment('教研室负责人');
            $table->string('opening_report_status', 10)->comment('开题报告状态');
            $table->text('amendment')->nullable()->comment('修改意见');

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
        Schema::drop('t_opening_report');
    }
}
