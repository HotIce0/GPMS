<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefenseTeamMemberForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_defense_team_member', function ($table){
            $table->foreign('defense_team_id')->references('defense_team_id')->on('t_defense_team');
            $table->foreign('team_member')->references('teacher_job_number')->on('t_teacher_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_defense_team_member', function ($table){
            $table->dropForeign(['defense_team_id']);
            $table->dropForeign(['team_member']);
        });
    }
}
