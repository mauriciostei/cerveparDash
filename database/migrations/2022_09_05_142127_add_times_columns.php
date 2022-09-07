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
        Schema::table('puntos', function (Blueprint $table) {
            $table->time('minimo')->default('00:01:00');
            $table->time('maximo')->default('18:00:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puntos', function (Blueprint $table) {
            //
        });
    }
};
