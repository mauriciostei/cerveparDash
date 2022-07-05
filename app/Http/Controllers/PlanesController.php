<?php

namespace App\Http\Controllers;

use App\Models\Planes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanesController extends Controller
{
    public function clonar(){
        $pl = new Planes();
        $pl->fecha = date('Y-m-d');
        $pl->save();

        DB::statement("
            insert into choferes_moviles_planes
            select cmp.choferes_id, cmp.moviles_id, ".$pl->id.", cmp.viaje, current_timestamp, current_timestamp
            from planes p
                join choferes_moviles_planes cmp on p.id = cmp.planes_id
            where p.fecha = current_date - 1
        ");
    }
}
