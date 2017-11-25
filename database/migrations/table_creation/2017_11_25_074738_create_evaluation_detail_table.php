<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_evaluation_detail', function (Blueprint $table) {
            $table->increments('evaluation_detail_id')->comment('评价详细ID');
            $table->integer('evaluation_id')->unsigned()->comment('评价ID');               //外键
            $table->string('evaluation_item', 10)->unique()->comment('评价项目');
            $table->string('evaluation_rank', 10)->unique()->comment('评价项目等级');

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
        Schema::drop('t_evaluation_detail');
    }
}
