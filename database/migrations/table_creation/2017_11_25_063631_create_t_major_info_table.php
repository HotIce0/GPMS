<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTMajorInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_major_info', function (Blueprint $table) {
            $table->increments('major_info_id');
            $table->string('major_identifier', 30)->unique()->comment('专业编号');
            $table->string('major_name', 50)->comment('专业名称');
            $table->integer('college_info_id')->unsigned()->comment('所属学院');                //外键

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
        Schema::drop('t_major_info');
    }
}
