<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTClassInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_class_info', function (Blueprint $table) {
            $table->increments('class_info_id');
            $table->string('class_identifier', 20)->unique()->comment('班级编号');
            $table->string('class_name', 50)->comment('班级名称');
            $table->integer('college_info_id')->unsigned()->comment('所属学院');

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
        Schema::drop('t_class_info');
    }
}
