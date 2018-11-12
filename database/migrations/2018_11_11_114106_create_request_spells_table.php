<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestSpellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_spells', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->unsigned()->nullable();
            $table->foreign('agent_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('approved')->default(0);
            $table->integer('spell_part_id')->nullable();
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
        Schema::dropIfExists('request_spells');
    }
}
