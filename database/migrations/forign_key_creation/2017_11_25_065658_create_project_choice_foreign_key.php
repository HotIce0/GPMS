<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectChoiceForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_project_choice', function ($table){
            $table->foreign('teacher_job_number')->references('teacher_job_number')->on('t_teacher_info');
            $table->foreign('college_info_id')->references('college_info_id')->on('t_college_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_project_choice', function ($table){
            $table->dropForeign(['teacher_job_number']);
            $table->dropForeign(['college_info_id']);
        });
    }
}
