<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alertas', function(Blueprint $table){
            $table->unsignedBigInteger('causa_raizs_id')->nullable();

            $table->foreign('causa_raizs_id')->references('id')->on('causa_raizs');
        });
    }

    public function down()
    {
        Schema::table('alertas', function(Blueprint $table){
            $table->dropConstrainedForeignId('causa_raizs_id');
        });
    }
};
