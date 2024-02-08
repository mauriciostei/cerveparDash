<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('recorridos', function(Blueprint $table){
            $table->index('moviles_id', 'moviles_id');
            $table->index('choferes_id', 'choferes_id');
            $table->index('sensores_id', 'sensores_id');
            $table->index('puntos_id', 'puntos_id');
            $table->index('tiers_id', 'tiers_id');
            $table->index('recorridos_id', 'recorridos_id');
            $table->index('viaje', 'viaje');
            $table->index('inicio', 'inicio');
        });
    }

    public function down()
    {
        Schema::table('recorridos', function(Blueprint $table){
            $table->dropIndex('moviles_id');
            $table->dropIndex('choferes_id');
            $table->dropIndex('sensores_id');
            $table->dropIndex('puntos_id');
            $table->dropIndex('tiers_id');
            $table->dropIndex('recorridos_id');
            $table->dropIndex('viaje');
            $table->dropIndex('inicio');
            $table->dropIndex('inicio_as_date');
        });
    }
};
