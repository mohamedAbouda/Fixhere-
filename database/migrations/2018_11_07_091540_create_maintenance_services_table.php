<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_services', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->default('')->nullable();
            $table->decimal('tech_fee', 20, 2)->unsigned()->default(0);
            $table->boolean('is_android_part')->default(0);
            $table->boolean('is_ios_part')->default(0);
            $table->boolean('is_delivery_part')->default(0);
            $table->integer('model_id')->unsigned()->nullable();
            $table->foreign('model_id')->references('id')->on('models')
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
        Schema::dropIfExists('maintenance_services');
    }
}
