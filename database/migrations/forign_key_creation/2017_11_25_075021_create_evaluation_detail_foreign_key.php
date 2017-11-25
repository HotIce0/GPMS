<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationDetailForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_evaluation_detail', function ($table){
            $table->foreign('evaluation_id')->references('evaluation_id')->on('t_evaluation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_evaluation_detail', function ($table){
            $table->dropForeign(['evaluation_id']);
        });
    }
}
