<?php

namespace App\Traits;

use App\Models\Alertas;
use App\Models\JornadaAyudantes;
use App\Models\Planes;
use App\Models\Recorridos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait NuevoRecorrido{

    use AddTime;
    use DifTime;

    public function ingresarRecorrido($sensor, $tier, $tipo_id, $id, $fechaHora){

        $fechaHora = $fechaHora ?? date('Y-m-d H:i:s');
        $plan = Planes::whereDate('fecha', date('Y-m-d'))->first();

        Log::info("Utilizando el plan: $plan->id");

        if($plan){
            $planificado = DB::table('choferes_moviles_planes')->where('planes_id', $plan->id)->where($tipo_id, $id)->orderBy('viaje')->get();

            if(count($planificado)){
                
                $tipo_busqueda = $tipo_id;
                $id_busqueda = $id;
                if(count($planificado) == 1 && $planificado[0]->viaje > 1){
                    $tipo_busqueda = ($tipo_id == 'moviles_id') ? 'choferes_id' : 'moviles_id';
                    $id_busqueda = $planificado[0]->$tipo_busqueda;
                }

                $ultimoRecorrido = Recorridos::whereDate('inicio', date('Y-m-d'))
                    ->where($tipo_busqueda, $id_busqueda)
                    ->orderByDesc('inicio')
                    ->orderByDesc('id')
                    ->first();
                
                $recorrido = new Recorridos();
                $recorrido->sensores_id = $sensor->id;
                $recorrido->puntos_id = $sensor->puntos_id;
                $recorrido->inicio = $fechaHora;
                $recorrido->tiers_id = $tier;
                $recorrido->moviles_id = $planificado[0]->moviles_id;
                $recorrido->choferes_id = $planificado[0]->choferes_id;
                $recorrido->ayudantes_id = $planificado[0]->ayudantes_id;
                $recorrido->viaje = 1;

                Log::info("Ingresó como planificado.Recorrido: $recorrido");
                Log::info("Ultimo Recorrido es: $ultimoRecorrido");

                $tiempo = DB::table('puntos_tiers')->where('tiers_id', $recorrido->tiers_id)->where('puntos_id', $recorrido->puntos_id)->where('viaje', $recorrido->viaje)->first();
                if($tiempo){
                    $recorrido->target = $this->addTime($tiempo->target, $fechaHora);
                    $recorrido->ponderacion = $this->addTime($tiempo->ponderacion, $recorrido->target);
                }else{
                    Log::info('SALIÓ SIN GUARDAR');
                    Log::info("Ultimo recorrido quedó así: $ultimoRecorrido");
                    return;
                }
        
                if($ultimoRecorrido){
        
                    if(!$ultimoRecorrido->fin){
                        $recorrido->recorridos_id = $ultimoRecorrido->id;
                        $ultimoRecorrido->fin = $fechaHora;
                        $recorrido->viaje = $ultimoRecorrido->viaje;
                    }elseif($ultimoRecorrido->fin && $ultimoRecorrido->viaje==1){
                        $totalPlanes = count($planificado) - 1;
                        if($totalPlanes==1 || ($totalPlanes==0 && $planificado[$totalPlanes]->viaje == 2)){

                            $diferencia = $this->difTime($ultimoRecorrido->fin);
                            if($diferencia < '01:00:00' && $recorrido->tiers_id==1){
                                Log::info("MENOS DE UNA HORA $diferencia");
                                return;
                            }

                            $recorrido->viaje = 2;
                            $recorrido->moviles_id = $planificado[$totalPlanes]->moviles_id;
                            $recorrido->choferes_id = $planificado[$totalPlanes]->choferes_id;
                            $recorrido->ayudantes_id = $planificado[$totalPlanes]->ayudantes_id;
                        }else{
                            Log::info('DATO DESCARTADO');
                            return;
                        }
                    }elseif($ultimoRecorrido->fin && $ultimoRecorrido->viaje==2){
                        return;
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

                    if($recorrido->inicio < $ultimoRecorrido->inicio){
                        $recorrido->inicio = date('Y-m-d H:i:s', strtotime($ultimoRecorrido->inicio." +1 minute"));
                        $ultimoRecorrido->fin = $recorrido->inicio;

                        $tiempo = DB::table('puntos_tiers')->where('tiers_id', $recorrido->tiers_id)->where('puntos_id', $recorrido->puntos_id)->where('viaje', $recorrido->viaje)->first();
                        $recorrido->target = $this->addTime($tiempo->target, $recorrido->inicio);
                        $recorrido->ponderacion = $this->addTime($tiempo->ponderacion, $recorrido->target);
                    }
                    
                    Log::info('Un paso antes de guardar ultimoRecorrido');
                    $ultimoRecorrido->save();
                }

                if($recorrido->target === $recorrido->inicio && $recorrido->ponderacion === $recorrido->inicio){
                    $recorrido->fin = $fechaHora;
                }
        
                $recorrido->save();
                return $recorrido;
            }
        }
    }

    public function ingresarJornadaAyudante($sensor, $ayudante, $fechaHora){

        $fechaHora = $fechaHora ?? date('Y-m-d H:i:s');

        $ja = new JornadaAyudantes();
        $ja->ayudantes_id = $ayudante->id;
        $ja->sensores_id = $sensor->id;
        $ja->puntos_id = $sensor->puntos_id;
        $ja->fecha_hora = $fechaHora;
        $ja->save();
    }
}