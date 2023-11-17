<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sensores', function (Blueprint $table) {
            $table->dropUnique(['codigo']);
        });
    }

    public function down()
    {
        Schema::table('sensores', function (Blueprint $table) {
            $table->string('codigo')->unique();
        });
    }
};
