<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sensores', function (Blueprint $table) {
            $table->string('direccion')->default('Todas');
        });
    }

    public function down()
    {
        Schema::table('sensores', function(Blueprint $table){
            $table->dropColumn('direccion');
        });
    }
};
