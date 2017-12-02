<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_notice', function (Blueprint $table) {
            $table->increments('notice_id')->comment('通知ID');
            $table->string('notice_type', 10)->comment('通知类型');
            $table->string('notice_sender', 20)->comment('通知发出人');          //外键
            $table->string('notice_title', 200)->comment('通知标题');
            $table->text('notice_content')->comment('通知内容');

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
        Schema::drop('t_notice');
    }
}
