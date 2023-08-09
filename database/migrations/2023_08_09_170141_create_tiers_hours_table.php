<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tiers_hours', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
            $table->unsignedBigInteger('tiers_id');
            $table->time('corte');
            $table->string('color');

            $table->foreign('tiers_id')->references('id')->on('tiers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tiers_hours');
    }
};
