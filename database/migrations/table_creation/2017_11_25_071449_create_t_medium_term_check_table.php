<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTMediumTermCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_medium_term_check', function (Blueprint $table) {
            $table->increments('medium_term_check_id')->comment('中期检查ID');
            $table->integer('version_number')->unsigned()->unique()->comment('版本号：每下达一次版本号加1');
            $table->integer('project_id')->unsigned()->comment('课题ID');                         //外键
            $table->timestamp('check_date')->comment('检查日期');
            $table->text('medium_term_check_content')->comment('情况记载');
            $table->string('medium_term_check_status', 10)->comment('中期检查状态');

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
        Schema::drop('t_medium_term_check');
    }
}
