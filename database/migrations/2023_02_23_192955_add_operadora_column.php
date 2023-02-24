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
        Schema::table('choferes', function (Blueprint $table) {
            $table->unsignedBigInteger('operadoras_id')->nullable();
            $table->foreign('operadoras_id')->references('id')->on('operadoras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('choferes', function(Blueprint $table){
            $table->dropConstrainedForeignId('operadoras_id');
        });
    }
};
