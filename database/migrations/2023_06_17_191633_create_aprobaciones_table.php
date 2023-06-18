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
        Schema::create('aprobaciones', function (Blueprint $table) {
            $table->id();
            $table->morphs('aprobacion');
            $table->unsignedBigInteger('users_id');
            $table->text('observacion');
            $table->integer('estado')->default(1);
            $table->text('observacion_resolucion')->nullable();
            $table->dateTime('fecha_resolucion')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('aprobaciones');
    }
};
