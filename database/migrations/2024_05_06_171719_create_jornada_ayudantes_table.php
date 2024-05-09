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
        Schema::create('jornada_ayudantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ayudantes_id');
            $table->unsignedBigInteger('sensores_id');
            $table->unsignedBigInteger('puntos_id');
            $table->timestamps();

            $table->dateTime('fecha_hora')->useCurrent();

            $table->foreign('ayudantes_id')->references('id')->on('ayudantes');
            $table->foreign('sensores_id')->references('id')->on('sensores');
            $table->foreign('puntos_id')->references('id')->on('puntos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jornada_ayudantes');
    }
};
