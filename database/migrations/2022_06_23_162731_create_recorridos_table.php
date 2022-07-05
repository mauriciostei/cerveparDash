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
        Schema::create('recorridos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('moviles_id')->nullable();
            $table->unsignedBigInteger('choferes_id')->nullable();
            $table->unsignedBigInteger('sensores_id');
            $table->unsignedBigInteger('puntos_id');
            $table->unsignedBigInteger('tiers_id');
            $table->unsignedBigInteger('recorridos_id')->nullable();

            $table->dateTime('inicio')->useCurrent();
            $table->dateTime('target');
            $table->dateTime('ponderacion');
            $table->dateTime('fin')->nullable();

            $table->integer('viaje')->default(1);
            $table->string('estado')->default('OnTime');

            $table->timestamps();

            $table->foreign('moviles_id')->references('id')->on('moviles');
            $table->foreign('choferes_id')->references('id')->on('choferes');
            $table->foreign('sensores_id')->references('id')->on('sensores');
            $table->foreign('puntos_id')->references('id')->on('puntos');
            $table->foreign('tiers_id')->references('id')->on('tiers');
            $table->foreign('recorridos_id')->references('id')->on('recorridos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recorridos');
    }
};
