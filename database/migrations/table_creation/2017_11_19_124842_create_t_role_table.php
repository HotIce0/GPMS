<?php
//By Sao Guang 2017.11.24
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
            $table->text('role_permission')->comment('角色拥有的权限编号,json存储');

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
        Schema::drop('t_role');
    }
}
