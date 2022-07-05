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
        Schema::create('problemas_soluciones', function (Blueprint $table) {
            //$table->id();
            $table->primary(['problemas_id', 'soluciones_id']);
            $table->unsignedBigInteger('problemas_id');
            $table->unsignedBigInteger('soluciones_id');
            $table->timestamps();

            $table->foreign('problemas_id')->references('id')->on('problemas');
            $table->foreign('soluciones_id')->references('id')->on('soluciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problemas_soluciones');
    }
};
