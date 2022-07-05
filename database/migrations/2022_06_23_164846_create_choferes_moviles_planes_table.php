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
        Schema::create('choferes_moviles_planes', function (Blueprint $table) {
            //$table->id();
            $table->primary(['choferes_id', 'moviles_id', 'planes_id', 'viaje']);
            $table->unsignedBigInteger('choferes_id');
            $table->unsignedBigInteger('moviles_id');
            $table->unsignedBigInteger('planes_id');
            $table->integer('viaje');
            $table->timestamps();

            $table->foreign('choferes_id')->references('id')->on('choferes');
            $table->foreign('moviles_id')->references('id')->on('moviles');
            $table->foreign('planes_id')->references('id')->on('planes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choferes_moviles_planes');
    }
};
