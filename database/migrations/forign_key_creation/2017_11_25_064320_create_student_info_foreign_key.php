<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInfoForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_student_info', function ($table){
            $table->foreign('college_info_id')->references('college_info_id')->on('t_college_info');
            $table->foreign('class_info_id')->references('class_info_id')->on('t_class_info');
            $table->foreign('major_info_id')->references('major_info_id')->on('t_major_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_student_info', function ($table){
            $table->dropForeign(['college_info_id']);
            $table->dropForeign(['class_info_id']);
            $table->dropForeign(['major_info_id']);
        });
    }
}
