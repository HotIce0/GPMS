<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTEvaluationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_evaluation', function (Blueprint $table) {
            $table->increments('evaluation_id')->comment('评价ID');
            $table->integer('project_id')->unsigned()->unique()->comment('课题ID');               //外键
            $table->string('evaluation_teacher_id', 20)->comment('评价教师');  //外键
            $table->timestamp('evaluation_date')->comment('评价日期');
            $table->string('evaluation_type', 10)->comment('评价类型');
            $table->string('evaluation_status', 10)->comment('评价状态');
            $table->text('remark')->comment('评语');
            $table->string('comprehensive_evaluation', 10)->comment('综合评价');

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
        Schema::drop('t_evaluation');
    }
}
