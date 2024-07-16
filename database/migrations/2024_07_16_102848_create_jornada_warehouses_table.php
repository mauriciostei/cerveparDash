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
        Schema::create('jornada_warehouses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('colaboradores_id');
            $table->unsignedBigInteger('sensores_id');
            $table->unsignedBigInteger('puntos_id');
            $table->timestamps();

            $table->dateTime('fecha_hora')->useCurrent();

            $table->foreign('colaboradores_id')->references('id')->on('colaboradores');
            $table->foreign('sensores_id')->references('id')->on('sensores');
            $table->foreign('puntos_id')->references('id')->on('puntos');
        });

        Permisos::create([
            'nombre' => 'Jornada Colaboradores',
            'link' => 'jornadaColaboradores',
            'categoria' => 'Dashboards',
            'icono' => 'fa-chart-line',
            'orden' => 26
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jornada_warehouses');
    }
};
