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
        Schema::create('sensores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('puntos_id');
            $table->string('nombre')->unique();
            $table->string('codigo')->unique();
            $table->boolean('activo')->default('true');
            $table->timestamps();

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
        Schema::dropIfExists('sensores');
    }
};
