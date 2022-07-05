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
        Schema::create('perfiles_users', function (Blueprint $table) {
            //$table->id();
            $table->unsignedBigInteger('perfiles_id');
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->foreign('perfiles_id')->references('id')->on('perfiles');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfiles_users');
    }
};
