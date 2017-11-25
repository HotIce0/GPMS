<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_evaluation', function ($table){
            $table->foreign('project_id')->references('project_id')->on('t_project_choice');
            $table->foreign('evaluation_teacher_id')->references('teacher_job_number')->on('t_teacher_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_evaluation', function ($table){
            $table->dropForeign(['project_id']);
            $table->dropForeign(['evaluation_teacher_id']);
        });
    }
}
