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
        Schema::create('aprobables_perfiles', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->primary(['aprobables_id', 'perfiles_id']);
            $table->unsignedBigInteger('aprobables_id');
            $table->unsignedBigInteger('perfiles_id');

            $table->foreign('aprobables_id')->references('id')->on('aprobables');
            $table->foreign('perfiles_id')->references('id')->on('perfiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aprobables_perfiles');
    }
};
