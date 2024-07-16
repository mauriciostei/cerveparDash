<?php

use App\Models\Permisos;
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
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->index();
            $table->bigInteger('cedula')->unsigned()->unique()->index();
            $table->timestamps();
        });

        Permisos::create([
            'nombre' => 'Colaboradores',
            'link' => 'colaboradoresList',
            'categoria' => 'MasterData',
            'icono' => 'fa-users',
            'orden' => 25
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colaboradores');
    }
};
