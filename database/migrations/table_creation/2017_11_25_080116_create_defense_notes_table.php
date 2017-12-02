<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefenseNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_defense_notes', function (Blueprint $table) {
            $table->increments('defense_notes_id')->comment('答辩记录ID');
            $table->integer('defense_team_id')->unsigned()->comment('答辩小组ID');     //外键
            $table->integer('project_id')->unsigned()->unique()->comment('课题ID');               //外键
            $table->timestamp('defense_date')->comment('答辩时间');
            $table->string('defense_place', 20)->comment('答辩地点');
            $table->string('note_taker', 20)->comment('记录人');                  //外键
            $table->text('defense_process_note')->comment('答辩过程记录');
            $table->text('defense_team_remark')->comment('答辩小组评语');
            $table->string('defense_team_evaluation', 10)->comment('答辩小组评定等级');
            $table->string('college_evaluation', 10)->comment('学院评定等级');

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
        Schema::drop('t_defense_notes');
    }
}
