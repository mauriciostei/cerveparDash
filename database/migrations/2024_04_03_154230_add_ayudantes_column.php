<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('choferes', function(Blueprint $table){
            $table->unsignedBigInteger('ayudantes_id')->nullable();

            $table->foreign('ayudantes_id')->references('id')->on('ayudantes');
        });
    }

    public function down()
    {
        Schema::table('choferes', function(Blueprint $table){
            $table->dropConstrainedForeignId('ayudantes_id');
        });
    }
};
