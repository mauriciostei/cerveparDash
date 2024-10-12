<?php

namespace App\Traits;

use App\Models\Recorridos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait AddRecorridoInMiddle{

    public function addRecorrido($tier_id, $viaje, $punto_id, $sensor_id, $fechaHora, $movil_id, $chofer_id, $ayudante_id){
        $punto = DB::table('puntos_tiers')->where('tiers_id', $tier_id)->where('viaje', $viaje)->where('puntos_id', $punto_id)->first();
        $orden = $punto->orden;

        $orden_mas = $orden + 1;
        $orden_menos = $orden - 1;

        $punto_anterior = DB::table('puntos_tiers')->where('tiers_id', $tier_id)->where('viaje', $viaje)->where('orden', $orden_menos)->first();
        $punto_siguiente = DB::table('puntos_tiers')->where('tiers_id', $tier_id)->where('viaje', $viaje)->where('orden', $orden_mas)->first();

        $recorrido = new Recorridos();
        $recorrido->sensores_id = $sensor_id;
        $recorrido->puntos_id = $punto_id;
        $recorrido->inicio = $fechaHora;
        $recorrido->tiers_id = $tier_id;
        $recorrido->moviles_id = $movil_id;
        $recorrido->choferes_id = $chofer_id;
        $recorrido->viaje = $viaje;
        $recorrido->estado = 'OnTime';
        $recorrido->target = $this->addTime($punto->target, $fechaHora);
        $recorrido->ponderacion = $this->addTime($punto->ponderacion, $recorrido->target);
        $recorrido->ayudantes_id = $ayudante_id;
        $recorrido->save();

        if($punto_anterior){
            $recorrido_anterior = Recorridos::
                whereDate('inicio', date('Y-m-d', strtotime($fechaHora)))
                ->where('moviles_id', $movil_id)
                ->where('choferes_id', $chofer_id)
                ->where('viaje', $viaje)
                ->where('puntos_id', $punto_anterior->puntos_id)
                ->first()
            ;

            if($recorrido_anterior){
                $recorrido->recorridos_id = $recorrido_anterior->id;
                $recorrido->save();
                $recorrido_anterior->fin = $recorrido->inicio;
                $recorrido_anterior->save();
            }
        }

        if($punto_siguiente){
            $recorrido_siguiente = Recorridos::
                whereDate('inicio', date('Y-m-d', strtotime($fechaHora)))
                ->where('moviles_id', $movil_id)
                ->where('choferes_id', $chofer_id)
                ->where('viaje', $viaje)
                ->where('puntos_id', $punto_siguiente->puntos_id)
                ->first()
            ;

            if($recorrido_siguiente){
                $recorrido->fin = $recorrido_siguiente->inicio;
                $recorrido->save();
                $recorrido_siguiente->recorridos_id = $recorrido->id;
                $recorrido_siguiente->save();
            }
        }else{
            $recorrido->fin = $recorrido->inicio;
            $recorrido->save();
        }
        
        Log::info(json_encode($recorrido));
    }
}