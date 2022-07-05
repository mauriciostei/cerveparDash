<?php

namespace Database\Seeders;

use App\Models\Recorridos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecorridosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = date('Y-m-d');
        $hora = ' 12';

        // Movil 1
        $r = new Recorridos();
        $r->moviles_id = 1;
        $r->choferes_id = 2;
        $r->sensores_id = 1;
        $r->puntos_id = 1;
        $r->tiers_id = 2;
        $r->inicio = $fecha.$hora.':00:00';
        $r->target = $fecha.$hora.':05:00';
        $r->ponderacion = $fecha.$hora.':07:00';
        $r->fin = $fecha.$hora.':04:25';
        $r->estado = 'OnTime';
        $r->save();

        $r = new Recorridos();
        $r->moviles_id = 1;
        $r->choferes_id = 2;
        $r->sensores_id = 3;
        $r->puntos_id = 2;
        $r->tiers_id = 2;
        $r->inicio = $fecha.$hora.':04:25';
        $r->target = $fecha.$hora.':08:25';
        $r->ponderacion = $fecha.$hora.':10:25';
        $r->estado = 'OnTime';
        $r->recorridos_id = 1;
        $r->save();

        // Movil 2
        $r = new Recorridos();
        $r->moviles_id = 3;
        $r->choferes_id = 2;
        $r->sensores_id = 1;
        $r->puntos_id = 1;
        $r->tiers_id = 2;
        $r->inicio = $fecha.$hora.':10:00';
        $r->target = $fecha.$hora.':15:00';
        $r->ponderacion = $fecha.$hora.':17:00';
        $r->estado = 'OutOfTime';
        $r->save();

        // Movil 3
        $r = new Recorridos();
        $r->moviles_id = 4;
        $r->choferes_id = 1;
        $r->sensores_id = 2;
        $r->puntos_id = 1;
        $r->tiers_id = 1;
        $r->inicio = $fecha.$hora.':00:00';
        $r->target = $fecha.$hora.':05:00';
        $r->ponderacion = $fecha.$hora.':07:00';
        $r->estado = 'OnTime';
        $r->save();
    }
}
