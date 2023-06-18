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
        Schema::create('cambios_recorridos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('moviles_id');
            $table->unsignedBigInteger('choferes_id');
            $table->unsignedBigInteger('sensores_id');
            $table->unsignedBigInteger('puntos_id');
            $table->unsignedBigInteger('tiers_id');

            $table->dateTime('inicio');
            $table->integer('viaje')->default(1);

            $table->timestamps();

            $table->foreign('moviles_id')->references('id')->on('moviles');
            $table->foreign('choferes_id')->references('id')->on('choferes');
            $table->foreign('sensores_id')->references('id')->on('sensores');
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
        Schema::dropIfExists('cambios_recorridos');
    }
};
