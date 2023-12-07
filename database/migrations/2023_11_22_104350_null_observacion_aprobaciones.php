<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('aprobaciones', function (Blueprint $table) {
            $table->text('observacion')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('aprobaciones', function (Blueprint $table) {
            $table->text('observacion')->change();
        });
    }
};
