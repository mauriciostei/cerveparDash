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
        Schema::create('plan_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planes_id');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->text('tipo')->default('Actualización por el sistema');
            $table->timestamps();

            $table->foreign('planes_id')->references('id')->on('planes');
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
        Schema::dropIfExists('plan_histories');
    }
};
