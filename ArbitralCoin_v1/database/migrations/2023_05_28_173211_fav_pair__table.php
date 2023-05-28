<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fav_pairs',function(Blueprint $table){
            $table->id();
            $table->string('pair');
            $table->bigInteger('user_preferences_id')->unsigned();
            $table->foreign('user_preferences_id')->references('id')->on('user_preferences');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fav_pairs');
    }
};
