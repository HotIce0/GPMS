<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentBookForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_assignment_book', function ($table){
            $table->foreign('project_id')->references('project_id')->on('t_project_choice');
            $table->foreign('teacher_job_number')->references('teacher_job_number')->on('t_teacher_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_assignment_book', function ($table){
            $table->dropForeign(['project_id']);
            $table->dropForeign(['teacher_job_number']);
        });
    }
}
