<?php
//By Sao Guang 2017.11.24
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
            $table->string('permission_no')->unique()->comment('权限编号');
            $table->string('permission_name', 255)->comment('用于说明权限');

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
        Schema::drop('t_permission');
    }
}
