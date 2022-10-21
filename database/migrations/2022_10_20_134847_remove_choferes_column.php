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
        Schema::table('moviles', function(Blueprint $table){
            $table->dropConstrainedForeignId('choferes_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moviles', function(Blueprint $table){
            $table->unsignedBigInteger('choferes_id')->nullable();
            $table->foreign('choferes_id')->references('id')->on('choferes');
        });
    }
};
