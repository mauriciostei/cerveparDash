<?php

namespace App\Traits;

use App\Models\Alertas;
use App\Models\Planes;
use App\Models\Recorridos;
use Illuminate\Support\Facades\DB;

trait NuevoRecorrido{

    use AddTime;

    public function ingresarRecorrido($sensor, $tier, $tipo_id, $id){

        $fechaHora = date('Y-m-d H:i:s');
        $plan = Planes::whereDate('fecha', date('Y-m-d'))->first();

        if($plan){
            $planificado = DB::table('choferes_moviles_planes')->where('planes_id', $plan->id)->where($tipo_id, $id)->orderBy('viaje')->get();

            if(count($planificado)>=1){
    
                $ultimoRecorrido = Recorridos::whereDate('inicio', date('Y-m-d'))
                    ->where($tipo_id, $id)
                    ->orderByDesc('inicio')
                    ->first();
                
                $recorrido = new Recorridos();
                $recorrido->sensores_id = $sensor->id;
                $recorrido->puntos_id = $sensor->puntos_id;
                $recorrido->inicio = $fechaHora;
                $recorrido->tiers_id = $tier;
                $recorrido->moviles_id = $planificado[0]->moviles_id;
                $recorrido->choferes_id = $planificado[0]->choferes_id;
                $recorrido->viaje = 1;
        
                if($ultimoRecorrido){
        
                    if(!$ultimoRecorrido->fin){
                        $recorrido->recorridos_id = $ultimoRecorrido->id;
                        $ultimoRecorrido->fin = $fechaHora;
                        $recorrido->viaje = $ultimoRecorrido->viaje;
                    }elseif($ultimoRecorrido->fin && $ultimoRecorrido->viaje==1){
                        if(count($planificado)==2){
                            $recorrido->viaje = 2;
                            $recorrido->moviles_id = $planificado[1]->moviles_id;
                            $recorrido->choferes_id = $planificado[1]->choferes_id;
                        }else{
                            return null;
                        }
                    }elseif($ultimoRecorrido->fin && $ultimoRecorrido->viaje==2){
                        return null;
                    }
        
                    if($ultimoRecorrido->estado == 'OutOfTime'){
                        $a = Alertas::where('recorridos_id', $ultimoRecorrido->id)->first();
                        if($a->users_id == null && $a->inicio == null){
                            $a->visible = false;
                            $a->fin = $fechaHora;
                            $a->observaciones = 'Alerta eliminada por Punto de control alcanzado';
                            $a->save();
                        }
                    }
        
                    $ultimoRecorrido->save();
        
                }
        
                $tiempo = DB::table('puntos_tiers')->where('tiers_id', $recorrido->tiers_id)->where('puntos_id', $recorrido->puntos_id)->where('viaje', $recorrido->viaje)->first();
                $recorrido->target = $this->addTime($tiempo->target, $fechaHora);
                $recorrido->ponderacion = $this->addTime($tiempo->ponderacion, $recorrido->target);

                if($recorrido->target === $recorrido->inicio && $recorrido->ponderacion === $recorrido->inicio){
                    $recorrido->fin = $fechaHora;
                }
        
                $recorrido->save();
            }
        }
    }
}