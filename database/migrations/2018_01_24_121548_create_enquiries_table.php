<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->increments('id');

            $table->text('message')->nullable();
            $table->string('title')->default('');

            $table->string('type')->default(''); //spare_parts //behavior

            $table->integer('from')->unsigned();
            $table->foreign('from')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('to')->unsigned()->nullable();
            $table->foreign('to')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->tinyInteger('status')->unsigned()->default(0);
            $table->string('group')->nullable();

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
        Schema::dropIfExists('enquiries');
    }
}
