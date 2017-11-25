<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreenMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_screen_message', function (Blueprint $table) {
            $table->increments('t_screen_message_id')->comment('画面消息ID');
            $table->string('message_number', 10)->unique()->comment('消息编号');
            $table->string('message_content', 256)->comment('消息内容');

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
        Schema::drop('t_screen_message');
    }
}
