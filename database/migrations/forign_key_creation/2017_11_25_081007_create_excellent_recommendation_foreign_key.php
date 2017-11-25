<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcellentRecommendationForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_excellent_recommendation', function ($table){
            $table->foreign('project_id')->references('project_id')->on('t_project_choice');
            $table->foreign('recommender')->references('teacher_job_number')->on('t_teacher_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_excellent_recommendation', function ($table){
            $table->dropForeign(['project_id']);
            $table->dropForeign(['recommender']);
        });
    }
}
