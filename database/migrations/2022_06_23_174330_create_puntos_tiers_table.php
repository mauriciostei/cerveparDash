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
        Schema::create('puntos_tiers', function (Blueprint $table) {
            //$table->id();
            $table->primary(['tiers_id', 'viaje', 'orden']);
            $table->unsignedBigInteger('puntos_id');
            $table->unsignedBigInteger('tiers_id');
            $table->integer('viaje');
            $table->integer('orden');

            $table->time('target');
            $table->time('ponderacion');

            $table->timestamps();

            $table->foreign('puntos_id')->references('id')->on('puntos');
            $table->foreign('tiers_id')->references('id')->on('tiers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puntos_tiers');
    }
};
