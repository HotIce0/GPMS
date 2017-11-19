<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_permission', function (Blueprint $table) {
            $table->increments('permission_id');
            $table->integer('permission_no')->unique()->comment('权限编号');
            $table->string('permission_name', 255)->comment('用于说明权限');
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
        Schema::drop('t_permission');
    }
}
