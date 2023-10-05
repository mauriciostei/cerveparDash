<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alertas', function(Blueprint $table){
            $table->unsignedBigInteger('causas_id')->nullable();

            $table->foreign('causas_id')->references('id')->on('causas');
        });
    }

    public function down()
    {
        Schema::table('alertas', function(Blueprint $table){
            $table->dropConstrainedForeignId('causas_id');
        });
    }
};
