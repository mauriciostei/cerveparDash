<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('planes', function(Blueprint $table){
            $table->unsignedBigInteger('users_id')->nullable();
            $table->dateTime('ultima_actualizacion')->nullable();

            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('planes', function(Blueprint $table){
            $table->dropConstrainedForeignId('users_id');
            $table->dropColumn('ultima_actualizacion');
        });
    }
};
