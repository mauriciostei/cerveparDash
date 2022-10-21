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
            $table->unsignedBigInteger('tiers_id')->default(2);
            $table->foreign('tiers_id')->references('id')->on('tiers');
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
            $table->dropConstrainedForeignId('tiers_id');
        });
    }
};
