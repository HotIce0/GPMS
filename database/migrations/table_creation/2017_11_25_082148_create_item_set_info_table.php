<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemSetInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('t_item_set_info', function (Blueprint $table) {
            $table->increments('item_id')->comment('选项ID');
            $table->integer('item_no')->unsigned()->comment('选项编号');
            $table->string('item_content_id', 10)->comment('选项内容ID');
            $table->string('item_content', 200)->comment('选项内容');
            $table->tinyInteger('sort_id')->unsigned()->comment('排序ID');
            $table->unique(['item_no','item_content_id']);

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
        Schema::drop('t_item_set_info');
    }
}
