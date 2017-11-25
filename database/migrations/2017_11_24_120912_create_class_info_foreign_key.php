<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassInfoForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_class_info', function ($table){
            $table->foreign('college_info_id')->references('college_info_id')->on('t_college_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_class_info', function ($table){
            $table->dropForeign(['college_info_id']);
        });
    }
}
