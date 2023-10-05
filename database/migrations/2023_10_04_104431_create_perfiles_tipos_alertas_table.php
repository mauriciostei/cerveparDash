<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('perfiles_tipos_alertas', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->primary(['tipos_alertas_id', 'perfiles_id']);
            $table->unsignedBigInteger('tipos_alertas_id');
            $table->unsignedBigInteger('perfiles_id');

            $table->foreign('tipos_alertas_id')->references('id')->on('tipos_alertas');
            $table->foreign('perfiles_id')->references('id')->on('perfiles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('perfiles_tipos_alertas');
    }
};
