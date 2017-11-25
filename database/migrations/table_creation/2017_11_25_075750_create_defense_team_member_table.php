<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefenseTeamMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_defense_team_member', function (Blueprint $table) {
            $table->increments('defense_team_member_id')->comment('答辩小组成员ID');
            $table->integer('defense_team_id')->unsigned()->comment('答辩小组ID');     //外键
            $table->string('team_member', 20)->comment('成员');                  //外键

            $table->string('creator', 20)->nullable();
            $table->string('updater', 20)->nullable();
            $table->string('deleter', 20)->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::drop('t_defense_team_member');
    }
}
