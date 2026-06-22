<?php

namespace App\Traits;

use App\Models\Alertas;
use App\Models\JornadaAyudantes;
use App\Models\JornadaWarehouse;
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
            $orden = 0;
            $viaje = 1;

            $ultimoRecorrido = Recorridos::whereDate('inicio', date('Y-m-d'))
                ->where($tipo_id, $id)
                ->orderByDesc('inicio')
                ->orderByDesc('id')
                ->first();
            Log::info("Ultimo recorrido obtenido: $ultimoRecorrido");

            if($ultimoRecorrido){
                if ($ultimoRecorrido->inicio === $ultimoRecorrido->fin) {
                    $viaje = $ultimoRecorrido->viaje + 1;
                    Log::info("Ultimo recorrido concluido se aumenta nivel de viaje a ($viaje)");
                } else {
                    $viaje = $ultimoRecorrido->viaje;
                    $orden = $ultimoRecorrido->orden;
                    Log::info("Ultimo recorrido en curso se establece viaje ($viaje) y orden ($orden)");
                }

                if($ultimoRecorrido->estado == 'OutOfTime'){
                    $a = Alertas::where('recorridos_id', $ultimoRecorrido->id)->where('tipos_alertas_id', 1)->first();
                    if($a->users_id == null && $a->inicio == null){
                        Log::info("Se eliminan las alertas del ultimo recorrido");
                        $a->visible = false;
                        $a->fin = $fechaHora;
                        $a->observaciones = 'Alerta eliminada por Punto de control alcanzado';
                        $a->save();
                    }
                }
            }

            $planificado = DB::table('choferes_moviles_planes')
                ->where('planes_id', $plan->id)
                ->where($tipo_id, $id)
                ->where('viaje', $viaje)
                ->first();
            Log::info("Se obtiene la planificacion de la entidad ($planificado)");

            $tiempo = DB::table('puntos_tiers')
                ->where('tiers_id', $tier)
                ->where('puntos_id', $sensor->puntos_id)
                ->where('viaje', $viaje)
                ->where('orden', '>', $orden)
                ->orderBy('orden', 'asc')
                ->first();
            Log::info("Se obtiene el viaje establecido ($tiempo)");

            $recorrido = new Recorridos();
            $recorrido->sensores_id = $sensor->id;
            $recorrido->puntos_id = $sensor->puntos_id;
            $recorrido->inicio = $fechaHora;
            $recorrido->tiers_id = $tier;
            $recorrido->moviles_id = $planificado->moviles_id;
            $recorrido->choferes_id = $planificado->choferes_id;
            $recorrido->ayudantes_id = $planificado->ayudantes_id;
            $recorrido->ayudantes_id = $planificado->ayudantes_id;
            $recorrido->viaje = $viaje;
            $recorrido->orden = $tiempo->orden;
            $recorrido->target = $this->addTime($tiempo->target, $fechaHora);
            $recorrido->ponderacion = $this->addTime($tiempo->ponderacion, $recorrido->target);
            Log::info("Se crea el recorrido base ($recorrido)");

            if ($ultimoRecorrido && !$ultimoRecorrido->fin) {
                $recorrido->recorridos_id = $ultimoRecorrido->id;
                $ultimoRecorrido->fin = $recorrido->inicio;
                $ultimoRecorrido->save();

                Log::info("Como el ultimo recorrido aun no finalizo se actualizo su fin y se referencia el recorrido a el ($recorrido)");
            }

            $puntoFinal = DB::table('puntos_tiers')
                ->where('tiers_id', $tier)
                ->where('viaje', $viaje)
                ->orderBy('orden', 'desc')
                ->first();
            Log::info("Se obtiene el ultimo punto del viaje ($puntoFinal)");

            if ($sensor->puntos_id === $puntoFinal->puntos_id && $recorrido->target === $recorrido->inicio && $recorrido->ponderacion === $recorrido->inicio) {
                $recorrido->fin = $recorrido->inicio;
                Log::info("Como se trata del ultimo punto se procede a establecer el fin igual al inicio ($recorrido)");
            }

            $recorrido->save();
            Log::info("Se guardo el recorrido ya finalizado ($recorrido)");
            return $recorrido;

            // $planificado = DB::table('choferes_moviles_planes')->where('planes_id', $plan->id)->where($tipo_id, $id)->orderBy('viaje')->get();

            // if(count($planificado)){
            //     $orden = 0;
                
            //     $tipo_busqueda = $tipo_id;
            //     $id_busqueda = $id;
            //     if(count($planificado) == 1 && $planificado[0]->viaje > 1){
            //         $tipo_busqueda = ($tipo_id == 'moviles_id') ? 'choferes_id' : 'moviles_id';
            //         $id_busqueda = $planificado[0]->$tipo_busqueda;
            //     }

            //     $ultimoRecorrido = Recorridos::whereDate('inicio', date('Y-m-d'))
            //         ->where($tipo_busqueda, $id_busqueda)
            //         ->orderByDesc('inicio')
            //         ->orderByDesc('id')
            //         ->first();
                
            //     if($ultimoRecorrido){
            //         $orden = $ultimoRecorrido->orden;
            //     }

            //     $recorrido = new Recorridos();
            //     $recorrido->sensores_id = $sensor->id;
            //     $recorrido->puntos_id = $sensor->puntos_id;
            //     $recorrido->inicio = $fechaHora;
            //     $recorrido->tiers_id = $tier;
            //     $recorrido->moviles_id = $planificado[0]->moviles_id;
            //     $recorrido->choferes_id = $planificado[0]->choferes_id;
            //     $recorrido->ayudantes_id = $planificado[0]->ayudantes_id;
            //     $recorrido->viaje = 1;

            //     Log::info("Ingresó como planificado.Recorrido: $recorrido");
            //     Log::info("Ultimo Recorrido es: $ultimoRecorrido");

            //     $tiempo = DB::table('puntos_tiers')
            //         ->where('tiers_id', $recorrido->tiers_id)
            //         ->where('puntos_id', $recorrido->puntos_id)
            //         ->where('viaje', $recorrido->viaje)
            //         ->where('orden', '>', $orden)
            //         ->orderBy('orden', 'asc')
            //         ->first();
            //     if($tiempo){
            //         $recorrido->target = $this->addTime($tiempo->target, $fechaHora);
            //         $recorrido->ponderacion = $this->addTime($tiempo->ponderacion, $recorrido->target);
            //         $recorrido->orden = $tiempo->orden;
            //     }else{
            //         Log::info('SALIÓ SIN GUARDAR');
            //         Log::info("Ultimo recorrido quedó así: $ultimoRecorrido");
            //         return;
            //     }
        
            //     if($ultimoRecorrido){
        
            //         if(!$ultimoRecorrido->fin){
            //             $recorrido->recorridos_id = $ultimoRecorrido->id;
            //             $ultimoRecorrido->fin = $fechaHora;
            //             $recorrido->viaje = $ultimoRecorrido->viaje;
            //         }elseif($ultimoRecorrido->fin && $ultimoRecorrido->viaje==1){
            //             $totalPlanes = count($planificado) - 1;
            //             if($totalPlanes==1 || ($totalPlanes==0 && $planificado[$totalPlanes]->viaje == 2)){

            //                 $diferencia = $this->difTime($ultimoRecorrido->fin);
            //                 if($diferencia < '01:00:00' && $recorrido->tiers_id==1){
            //                     Log::info("MENOS DE UNA HORA $diferencia");
            //                     return;
            //                 }

            //                 $recorrido->viaje = 2;
            //                 $recorrido->moviles_id = $planificado[$totalPlanes]->moviles_id;
            //                 $recorrido->choferes_id = $planificado[$totalPlanes]->choferes_id;
            //                 $recorrido->ayudantes_id = $planificado[$totalPlanes]->ayudantes_id;
            //             }else{
            //                 Log::info('DATO DESCARTADO');
            //                 return;
            //             }
            //         }elseif($ultimoRecorrido->fin && $ultimoRecorrido->viaje==2){
            //             return;
            //         }
        
            //         if($ultimoRecorrido->estado == 'OutOfTime'){
            //             $a = Alertas::where('recorridos_id', $ultimoRecorrido->id)->where('tipos_alertas_id', 1)->first();
            //             if($a->users_id == null && $a->inicio == null){
            //                 $a->visible = false;
            //                 $a->fin = $fechaHora;
            //                 $a->observaciones = 'Alerta eliminada por Punto de control alcanzado';
            //                 $a->save();
            //             }
            //         }

            //         if($recorrido->inicio < $ultimoRecorrido->inicio){
            //             $recorrido->inicio = date('Y-m-d H:i:s', strtotime($ultimoRecorrido->inicio." +1 minute"));
            //             $ultimoRecorrido->fin = $recorrido->inicio;

            //             $tiempo = DB::table('puntos_tiers')->where('tiers_id', $recorrido->tiers_id)->where('puntos_id', $recorrido->puntos_id)->where('viaje', $recorrido->viaje)->first();
            //             $recorrido->target = $this->addTime($tiempo->target, $recorrido->inicio);
            //             $recorrido->ponderacion = $this->addTime($tiempo->ponderacion, $recorrido->target);
            //         }
                    
            //         Log::info('Un paso antes de guardar ultimoRecorrido');
            //         $ultimoRecorrido->save();
            //     }

            //     if($recorrido->target === $recorrido->inicio && $recorrido->ponderacion === $recorrido->inicio){
            //         $recorrido->fin = $fechaHora;
            //     }
        
            //     $recorrido->save();
            //     return $recorrido;
            // }
        }
    }

    public function ingresarJornadaAyudante($sensor, $ayudante, $fechaHora){

        $fechaHora = $fechaHora ?? date('Y-m-d H:i:s');

        $exists = DB::select("select * from jornada_ayudantes where cast(fecha_hora as date) = current_date and sensores_id = $sensor->id and ayudantes_id = $ayudante->id");
        if($exists){
            return;
        }

        $jornadaAyudante = new JornadaAyudantes();
        $jornadaAyudante->ayudantes_id = $ayudante->id;
        $jornadaAyudante->sensores_id = $sensor->id;
        $jornadaAyudante->puntos_id = $sensor->puntos_id;
        $jornadaAyudante->fecha_hora = $fechaHora;
        $jornadaAyudante->save();
    }

    public function ingresarJornadaColaboradores($sensor, $colaborador, $fechaHora){

        $fechaHora = $fechaHora ?? date('Y-m-d H:i:s');

        $exists = DB::select("select * from jornada_warehouses where cast(fecha_hora as date) = current_date and sensores_id = $sensor->id and colaboradores_id = $colaborador->id");
        if($exists){
            return;
        }

        $jornadaColaborador = new JornadaWarehouse();
        $jornadaColaborador->colaboradores_id = $colaborador->id;
        $jornadaColaborador->sensores_id = $sensor->id;
        $jornadaColaborador->puntos_id = $sensor->puntos_id;
        $jornadaColaborador->fecha_hora = $fechaHora;
        $jornadaColaborador->save();
    }
}