<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherInfoForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_teacher_info', function ($table){
            $table->foreign('college_info_id')->references('college_info_id')->on('t_college_info');
            $table->foreign('section_info_id')->references('section_info_id')->on('t_section_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_teacher_info', function ($table){
            $table->dropForeign(['college_info_id']);
            $table->dropForeign(['section_info_id']);
        });
    }
}
