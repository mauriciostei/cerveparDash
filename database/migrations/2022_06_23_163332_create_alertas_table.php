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
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recorridos_id');
            $table->unsignedBigInteger('problemas_id')->nullable();
            $table->unsignedBigInteger('soluciones_id')->nullable();
            $table->unsignedBigInteger('users_id')->nullable();

            $table->dateTime('inicio')->nullable();
            $table->dateTime('fin')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('visible')->default('true');
            $table->boolean('notificado')->default('false');

            $table->timestamps();

            $table->foreign('recorridos_id')->references('id')->on('recorridos');
            $table->foreign('problemas_id')->references('id')->on('problemas');
            $table->foreign('soluciones_id')->references('id')->on('soluciones');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alertas');
    }
};
