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
        Schema::create('tiers_viajes', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            $table->unique(['tiers_id', 'viajes_id']);
            $table->unsignedBigInteger('tiers_id');
            $table->unsignedBigInteger('viajes_id');
            $table->time('tiempo_tma')->default('00:00:00');

            $table->foreign('tiers_id')->references('id')->on('tiers');
            $table->foreign('viajes_id')->references('id')->on('viajes');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiers_viajes');
    }
};
