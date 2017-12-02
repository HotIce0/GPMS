<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTAssignmentBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_assignment_book', function (Blueprint $table) {
            $table->increments('assignment_book_id')->comment('任务书ID');
            $table->integer('version_number')->unsigned()->unique()->comment('版本号：每下达一次版本号加1');
            $table->integer('project_id')->unsigned()->comment('课题ID');                         //外键
            $table->timestamp('order_date')->comment('下达时间');
            $table->text('key_word')->comment('主题词，关键词');
            $table->text('content_requirement')->comment('内容要求');
            $table->text('guidelines_for_documentation')->comment('文献查阅指引');
            $table->text('scheduling')->comment('进度安排');
            $table->text('section_view')->comment('教研室意见');
            $table->string('teacher_job_number', 20)->commment('教研室负责人');           //外键
            $table->string('assignment_book_status', 10)->comment('任务书状态');

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
        Schema::drop('t_assignment_book');
    }
}
