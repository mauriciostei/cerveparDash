<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait CorrespondeViaje{

    public function corresponde($fecha, $movil, $chofer, $viaje){
        $query = DB::select(DB::raw("select corresponde
        from planes p
            join choferes_moviles_planes cmp on p.id = cmp.planes_id
        where p.fecha = '$fecha'
            and moviles_id = $movil
            and choferes_id = $chofer
            and viaje = $viaje"));

        if(count($query) == 0){ return 'NO'; }

        return $query[0]->corresponde ? 'SI' : 'NO';
    }
    
}