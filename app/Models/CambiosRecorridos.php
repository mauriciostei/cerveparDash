<?php

namespace App\Models;

use App\Traits\AddTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CambiosRecorridos extends Model
{
    use HasFactory;
    use AddTime;

    public function moviles(){
        return $this->belongsTo(Moviles::class);
    }

    public function choferes(){
        return $this->belongsTo(Choferes::class);
    }

    public function sensores(){
        return $this->belongsTo(Sensores::class);
    }

    public function puntos(){
        return $this->belongsTo(Puntos::class);
    }

    public function tiers(){
        return $this->belongsTo(Tiers::class);
    }

    public function aprobaciones(){
        return $this->morphOne(Aprobaciones::class, 'aprobacion');
    }

    public function rechazar(){}

    public function aprobar(){
        $punto = DB::table('puntos_tiers')->where('tiers_id', $this->tiers_id)->where('viaje', $this->viaje)->where('puntos_id', $this->puntos_id)->first();
        $orden = $punto->orden;

        $orden_mas = $orden + 1;
        $orden_menos = $orden - 1;

        $punto_anterior = DB::table('puntos_tiers')->where('tiers_id', $this->tiers_id)->where('viaje', $this->viaje)->where('orden', $orden_menos)->first();
        $punto_siguiente = DB::table('puntos_tiers')->where('tiers_id', $this->tiers_id)->where('viaje', $this->viaje)->where('orden', $orden_mas)->first();

        $chofer = Choferes::find($this->choferes_id);

        $recorrido = new Recorridos();
        $recorrido->sensores_id = $this->sensores_id;
        $recorrido->puntos_id = $this->puntos_id;
        $recorrido->inicio = $this->inicio;
        $recorrido->tiers_id = $this->tiers_id;
        $recorrido->moviles_id = $this->moviles_id;
        $recorrido->choferes_id = $this->choferes_id;
        $recorrido->viaje = $this->viaje;
        $recorrido->estado = 'OnTime';
        $recorrido->target = $this->addTime($punto->target, $this->inicio);
        $recorrido->ponderacion = $this->addTime($punto->ponderacion, $recorrido->target);
        $recorrido->ayudantes_id = $chofer->ayudantes_id;
        $recorrido->save();

        if($punto_anterior){
            $recorrido_anterior = Recorridos::
                whereDate('inicio', date('Y-m-d', strtotime($this->inicio)))
                ->where('moviles_id', $this->moviles_id)
                ->where('choferes_id', $this->choferes_id)
                ->where('viaje', $this->viaje)
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
                whereDate('inicio', date('Y-m-d', strtotime($this->inicio)))
                ->where('moviles_id', $this->moviles_id)
                ->where('choferes_id', $this->choferes_id)
                ->where('viaje', $this->viaje)
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
    }
}
