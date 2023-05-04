<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('choferes_moviles_planes', function (Blueprint $table) {
            $table->time('hora_esperada')->nullable();
        });
    }

    public function down()
    {
        Schema::table('choferes_moviles_planes', function(Blueprint $table){
            $table->dropColumn('hora_esperada');
        });
    }
};
