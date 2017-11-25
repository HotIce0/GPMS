<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationPlanForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_evaluation_plan', function ($table){
            $table->foreign('advisor')->references('teacher_info_id')->on('t_teacher_info');
            $table->foreign('reviewer')->references('teacher_info_id')->on('t_teacher_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_evaluation_plan', function ($table){
            $table->dropForeign(['advisor']);
            $table->dropForeign(['reviewer']);
        });
    }
}
