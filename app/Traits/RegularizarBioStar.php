<?php

namespace App\Traits;

use App\Models\Sensores;
use Illuminate\Support\Facades\DB;

trait RegularizarBioStar{
    use AddTime;
    use AddRecorridoInMiddle;

    public function regularizarData($response){
        $pendientes = DB::select("select cmp.choferes_id
            , cmp.moviles_id
            , cmp.planes_id
            , cmp.viaje
            , cmp.ayudantes_id
            , pt.tiers_id
            , pt.puntos_id
            , pt.orden
            , c.documento
        from planes p
            join choferes_moviles_planes cmp on p.id = cmp.planes_id
            join choferes c on cmp.choferes_id = c.id
            join puntos_tiers pt on pt.tiers_id = c.tiers_id and pt.viaje = cmp.viaje
            left join recorridos r on cast(r.inicio as date) = current_date and r.choferes_id = c.id and r.puntos_id = pt.puntos_id
        where p.fecha = current_date
            and r.id is null
        order by c.id, pt.orden"
        );

        foreach($pendientes as $line):
            
            $sensores = DB::select("select s.codigo from puntos p join sensores s on p.id = s.puntos_id where p.id = $line->puntos_id");
            
            foreach($response as $biostar):
                $findSensor = false;

                foreach($sensores as $sensor):
                    if($sensor->codigo == $biostar->device_id->id){
                        $findSensor = true;
                    }
                endforeach;

                if($findSensor && $biostar->user_id->user_id == $line->documento){
                    $fechaHora = date('Y-m-d H:i:s', strtotime($biostar->datetime));

                    $sensor = Sensores::where('codigo', $biostar->device_id->id)->where('activo', true)->first();

                    $this->addRecorrido($line->tiers_id, $line->viaje, $line->puntos_id, $sensor->id, $fechaHora, $line->moviles_id, $line->choferes_id, $line->ayudantes_id);
                    break;
                }
            endforeach;
        endforeach;
    }
}