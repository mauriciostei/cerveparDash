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
        Schema::create('limite', function (Blueprint $table) {
            $table->id();
            $table->integer('rango');
            $table->unsignedBigInteger('tiers_id');
            $table->unsignedInteger('lunes');
            $table->unsignedInteger('martes');
            $table->unsignedInteger('miercoles');
            $table->unsignedInteger('jueves');
            $table->unsignedInteger('viernes');
            $table->unsignedInteger('sabado');
            $table->unsignedInteger('domingo');

            $table->timestamps();

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
        Schema::dropIfExists('limite');
    }
};
