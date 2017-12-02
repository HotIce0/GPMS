<?php
//By : SaoGuang
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTCollegeInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_college_info', function (Blueprint $table) {
            $table->increments('college_info_id');
            $table->string('college_identifier', 20)->unique()->comment('学院编号');
            $table->string('college_name', 50)->comment('学院名称');

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
        Schema::drop('t_college_info');
    }
}
