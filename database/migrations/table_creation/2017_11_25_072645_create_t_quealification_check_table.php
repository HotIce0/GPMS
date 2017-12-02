<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTQuealificationCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_qualification_check', function (Blueprint $table) {
            $table->increments('qualification_check_id')->comment('资格审查ID');
            $table->integer('version_number')->unsigned()->unique()->comment('版本号：每下达一次版本号加1');
            $table->integer('answer_application_id')->unsigned()->comment('答辩申请ID');              //外键

            $table->text('check_item1')->comment('审查项目1');
            $table->text('check_item2')->comment('审查项目2');
            $table->text('check_item3')->comment('审查项目3');
            $table->text('check_item4')->comment('审查项目4');
            $table->text('check_item5')->comment('审查项目5');
            $table->text('check_item6')->comment('审查项目6');
            $table->text('check_item7')->comment('审查项目7');
            $table->text('check_item8')->comment('审查项目8');

            $table->timestamp('check_date')->comment('审查日期');
            $table->text('check_amendment')->comment('审查意见');
            $table->string('qualification_check_status', 10)->commment('审查状态');

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
        Schema::drop('t_qualification_check');
    }
}
