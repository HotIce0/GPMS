<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefenseTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_defense_team', function (Blueprint $table) {
            $table->increments('defense_team_id')->comment('答辩小组ID');
            $table->string('session_id', 10)->comment('届别ID');
            $table->string('team_member', 20)->unique()->comment('组长');     //外键

            $table->string('creator', 20)->nullable();
            $table->string('updater', 20)->nullable();
            $table->string('deleter', 20)->nullable();
            $table->softDeletes();
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
        Schema::drop('t_defense_team');
    }
}
