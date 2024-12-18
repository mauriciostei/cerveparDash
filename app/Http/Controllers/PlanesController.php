<?php

namespace App\Http\Controllers;

use App\Models\Planes;
use App\Models\PlanHistory;
use Illuminate\Support\Facades\DB;

class PlanesController extends Controller
{
    public function clonar(){
        $planAnterior = Planes::latest()->first();

        $pl = new Planes();
        $pl->fecha = date('Y-m-d', strtotime(now().' +1 days'));
        $pl->ultima_actualizacion = $planAnterior->ultima_actualizacion;
        $pl->users_id = 1;
        $pl->save();

        DB::statement("
            insert into choferes_moviles_planes
            select cmp.choferes_id, cmp.moviles_id, ".$pl->id.", cmp.viaje, current_timestamp, current_timestamp, cmp.hora_esperada, true, c.ayudantes_id
            from planes p
                join choferes_moviles_planes cmp on p.id = cmp.planes_id
                join choferes c on c.id = cmp.choferes_id
            where p.fecha = current_date
        ");

        PlanHistory::create([
            'users_id' => 1,
            'planes_id' => $pl->id,
            'tipo' => 'Generado automáticamente por el sistema'
        ]);
    }
}
