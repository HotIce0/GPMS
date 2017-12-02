<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTThesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_thesis', function (Blueprint $table) {
            $table->increments('thesis_id')->comment('论文ID');
            $table->integer('version_number')->unsigned()->unique()->comment('版本号：每下达一次版本号加1');
            $table->integer('project_id')->unsigned()->comment('课题ID');                         //外键
            $table->timestamp('submit_date')->comment('提交日期');
            $table->string('thesis_url', 100)->comment('论文文件路径');
            $table->string('thesis_status', 10)->commment('论文状态');
            $table->text('amendment')->comment('修改意见');

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
        Schema::drop('t_thesis');
    }
}
