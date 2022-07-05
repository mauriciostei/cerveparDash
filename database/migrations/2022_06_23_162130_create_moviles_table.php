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
        Schema::create('moviles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tiers_id');
            $table->unsignedBigInteger('choferes_id')->nullable();
            $table->string('nombre')->unique();
            $table->string('chapa')->unique();
            $table->boolean('activo')->default('true');
            $table->timestamps();

            $table->foreign('tiers_id')->references('id')->on('tiers');
            $table->foreign('choferes_id')->references('id')->on('choferes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moviles');
    }
};
