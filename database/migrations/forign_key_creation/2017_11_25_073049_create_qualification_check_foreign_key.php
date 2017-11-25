<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationCheckForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_qualification_check', function ($table){
            $table->foreign('answer_application_id')->references('answer_application_id')->on('t_answer_application');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_qualification_check', function ($table){
            $table->dropForeign(['answer_application_id']);
        });
    }
}
