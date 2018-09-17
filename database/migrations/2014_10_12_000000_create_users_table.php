<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email',191)->unique()->nullable();
            $table->string('password')->nullable();

            $table->string('lat')->default('');
            $table->string('lng')->default('');
            $table->string('location')->default('');
            $table->string('contact_number')->default('');
            $table->text('description')->nullable();
            $table->string('profile_image')->default('');
            $table->string('cover_image')->default('');
            $table->decimal('cost_per_hour',20,2)->default(0);
            $table->integer('rate')->unsigned()->default(0);
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('card_pan')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_token')->nullable();
            $table->string('social_id')->nullable();
            $table->string('social_type')->nullable();

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
        Schema::dropIfExists('users');
    }
}
