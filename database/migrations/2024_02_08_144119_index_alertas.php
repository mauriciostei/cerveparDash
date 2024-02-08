<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alertas', function(Blueprint $table){
            $table->index('recorridos_id', 'index_recorridos_id');
            $table->index('problemas_id', 'index_problemas_id');
            $table->index('soluciones_id', 'index_soluciones_id');
            $table->index('users_id', 'index_users_id');
            $table->index('inicio', 'index_inicio');
            $table->index('fin', 'index_fin');
            $table->index('created_at', 'index_created_at');
            $table->index('tipos_alertas_id', 'index_tipos_alertas_id');
            $table->index('causas_id', 'index_causas_id');
            $table->index('causa_raizs_id', 'index_causa_raizs_id');
        });
    }

    public function down()
    {
        Schema::table('alertas', function(Blueprint $table){
            $table->dropIndex('index_recorridos_id');
            $table->dropIndex('index_problemas_id');
            $table->dropIndex('index_soluciones_id');
            $table->dropIndex('index_users_id');
            $table->dropIndex('index_inicio');
            $table->dropIndex('index_fin');
            $table->dropIndex('index_created_at');
            $table->dropIndex('index_tipos_alertas_id');
            $table->dropIndex('index_causas_id');
            $table->dropIndex('index_causa_raizs_id');
        });
    }
};
