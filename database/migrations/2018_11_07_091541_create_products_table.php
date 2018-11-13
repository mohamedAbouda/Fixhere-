<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->default('')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->integer('stock')->unsigned()->default(0);
            $table->decimal('price', 20, 2)->unsigned()->default(0);
            $table->boolean('is_android_part')->default(0);
            $table->boolean('is_ios_part')->default(0);
            $table->boolean('is_delivery_part')->default(0);

            $table->integer('model_id')->unsigned()->nullable();
            $table->foreign('model_id')->references('id')->on('models')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('maintenance_service_id')->unsigned()->nullable();
            $table->foreign('maintenance_service_id')->references('id')->on('maintenance_services')
            ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
}
