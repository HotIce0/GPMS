<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcellentRecommendationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_excellent_recommendation', function (Blueprint $table) {
            $table->increments('excellent_recommendation_id')->comment('优秀推荐ID');
            $table->integer('project_id')->unsigned()->comment('课题ID');               //外键
            $table->string('recommender', 20)->comment('推荐人');                //外键
            $table->text('recommender_view')->comment('推荐人建议');
            $table->timestamp('recommendation_date')->comment('推荐时间');
            $table->text('college_view')->comment('学院领导小组意见');
            $table->timestamp('college_view_date')->comment('学院意见日期');

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
        Schema::drop('t_excellent_recommendation');
    }
}
