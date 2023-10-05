<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alertas', function(Blueprint $table){
            $table->unsignedBigInteger('tipos_alertas_id')->nullable();

            $table->foreign('tipos_alertas_id')->references('id')->on('tipos_alertas');
        });
    }

    public function down()
    {
        Schema::table('alertas', function(Blueprint $table){
            $table->dropConstrainedForeignId('tipos_alertas_id');
        });
    }
};
