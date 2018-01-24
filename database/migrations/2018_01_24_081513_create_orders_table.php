<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('service_type')->default('');

            $table->integer('center_id')->unsigned()->nullable();
            $table->foreign('center_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('agent_id')->unsigned();
            $table->foreign('agent_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->date('order_date');
            $table->time('time_from');
            $table->time('time_to');
            $table->string('lat')->default('');
            $table->string('lng')->default('');
            $table->text('problem')->nullable();
            $table->tinyInteger('status')->unsigned()->default(0);

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
        Schema::dropIfExists('orders');
    }
}
