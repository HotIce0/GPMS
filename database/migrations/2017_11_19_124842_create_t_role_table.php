<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_role', function (Blueprint $table) {
            $table->increments('role_id');
            $table->string('role_name', 255)->comment('角色名称');
            $table->string('role_permission', 255)->comment('角色拥有的权限编号,json存储');
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
        Schema::drop('t_role');
    }
}
