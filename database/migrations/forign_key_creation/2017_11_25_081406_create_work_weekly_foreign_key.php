<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkWeeklyForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_work_weekly', function ($table){
            $table->foreign('project_id')->references('project_id')->on('t_project_choice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_work_weekly', function ($table){
            $table->dropForeign(['project_id']);
        });
    }
}
