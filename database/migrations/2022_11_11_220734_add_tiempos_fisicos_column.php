<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('puntos', function(Blueprint $table){
            $table->boolean('tiempos_fisicos')->default('false');
        });
    }

    public function down()
    {
        Schema::table('puntos', function(Blueprint $table){
            $table->dropColumn('tiempos_fisicos');
        });
    }
};
