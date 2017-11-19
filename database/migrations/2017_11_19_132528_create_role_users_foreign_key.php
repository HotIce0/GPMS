<?php

use Illuminate\Database\Migrations\Migration;

class CreateRoleUsersForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::table('t_users_basic_info', function ($table){
            $table->foreign('role_id')->references('role_id')->on('t_role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\Schema::table('t_users_basic_info', function ($table){
            $table->dropForeign(['role_id']);
        });
    }
}
