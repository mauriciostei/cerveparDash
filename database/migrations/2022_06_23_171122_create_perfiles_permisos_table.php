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
        Schema::create('perfiles_permisos', function (Blueprint $table) {
            //$table->id();
            $table->primary(['perfiles_id', 'permisos_id']);
            $table->unsignedBigInteger('perfiles_id');
            $table->unsignedBigInteger('permisos_id');

            $table->boolean('leer')->default('false');
            $table->boolean('crear')->default('false');
            $table->boolean('editar')->default('false');

            $table->timestamps();

            $table->foreign('perfiles_id')->references('id')->on('perfiles');
            $table->foreign('permisos_id')->references('id')->on('permisos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfiles_permisos');
    }
};
