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


            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('technician_id')->unsigned();
            $table->foreign('technician_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regions')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->text('description');
            $table->string('lat')->default('');
            $table->string('lng')->default('');
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->integer('payment_method')->default(0);
            $table->integer('value')->default(0);

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
