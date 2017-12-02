<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTAnswerApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_answer_application', function (Blueprint $table) {
            $table->increments('answer_application_id')->comment('答辩申请ID');
            $table->integer('version_number')->unsigned()->unique()->comment('版本号：每下达一次版本号加1');
            $table->integer('project_id')->unsigned()->comment('课题ID');                         //外键
            $table->timestamp('application_date')->comment('申请日期');
            $table->text('answer_application_content')->comment('内容记载');
            $table->string('answer_application_status', 10)->commment('答辩申请状态');

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
        Schema::drop('t_answer_application');
    }
}
