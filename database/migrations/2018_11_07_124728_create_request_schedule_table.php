<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->unsigned()->nullable();
            $table->foreign('request_id')->references('id')->on('requests')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->date('day_date');
            $table->time('day_time');
            $table->integer('sent_times')->default(0);
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
        Schema::dropIfExists('request_schedule');
    }
}
