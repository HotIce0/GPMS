<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTEvaluationPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_evaluation_plan', function (Blueprint $table) {
            $table->increments('evaluation_plan_id')->comment('评价计划ID');
            $table->string('session_id', 10)->comment('届别ID');
            $table->integer('advisor')->unsigned()->comment('指导教师');                //外键
            $table->integer('reviewer')->unsigned()->comment('评阅教师');                //外键

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
        Schema::drop('t_evaluation_plan');
    }
}
