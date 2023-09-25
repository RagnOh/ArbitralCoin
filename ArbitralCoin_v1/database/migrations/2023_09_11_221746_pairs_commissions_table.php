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
        Schema::create('pairs_commissions',function(Blueprint $table){
            $table->id();
            $table->string('exchange_name');
            $table->string('token');
            $table->decimal('minimum',12,3);
            $table->decimal('cost',12,3);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pairs_commissions');
    }
};
