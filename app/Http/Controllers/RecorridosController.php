<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Moviles;
use App\Models\Planes;
use App\Models\Puntos;
use App\Models\Recorridos;
use App\Models\Sensores;
use App\Providers\NewAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RecorridosController extends Controller
{
    public function OutTime(){
        $recorrido = Recorridos::
            where('created_at', '>=', date('Y-m-d').' 00:00:00')
            ->where('fin', null)
            ->where('estado', 'OnTime')
            ->where('target', '<', date('Y-m-d H:i:s')
        )->get();

        if($recorrido){
            foreach($recorrido as $r){
                $r->estado = 'OutOfTime';
                $r->save();

                $a = new Alertas();
                $a->recorridos_id = $r->id;
                $a->save();
                //event(new NewAlert($a));
            }
        }
    }

    public function Dismiss(){
        $recorrido = Recorridos::
            where('created_at', '>=', date('Y-m-d').' 00:00:00')
            ->where('fin', null)
            ->where('estado', 'OutOfTime')
            ->where('ponderacion', '<', date('Y-m-d H:i:s')
        )->get();

        //Log::info(json_encode($recorrido));

        if($recorrido){
            foreach($recorrido as $r){
                $r->estado = 'Dismiss';
                $r->save();

                $a = Alertas::where('recorridos_id', $r->id)->first();
                $a->visible = false;
                $a->fin = now();
                $a->observaciones = 'Alerta eliminada por sobrepaso de Ponderación';
                $a->save();
            }
        }
    }

    public function validarAlertas(){
        $alertas = Alertas::where('created_at', '<', date('Y-m-d').' 00:00:00')->whereNull('users_id')->whereNull('fin')->get();
        foreach($alertas as $a){
            $a->visible = false;
            $a->inicio = now();
            $a->fin = now();
            $a->observaciones = 'Alerta eliminada por cambio de dia';
            $a->save();

            $r = $a->recorridos;
            $r->estado = 'Dismiss';
            $r->save();
        }
    }

    public function ingresarMovil(Request $request){

        $file =  $request->file('anpr_xml');

        $fo = fopen($file, 'r');
        $contenido = fread($fo, filesize($file));
        fclose($fo);

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($contenido);

        $fechaHora = date_parse($xml->dateTime);
        $sensor = Sensores::where('codigo', $xml->channelName)->where('activo', true)->first();
        $movil = Moviles::where('chapa', $xml->ANPR->licensePlate)->where('activo', true)->first();
        $fechaHoraAct = now(); 

        if($fechaHora['hour']>=7 && $fechaHora['hour']<=22){
            if($movil && $sensor){
                $ultimoRecorrido = Recorridos::where('created_at', '>=', date('Y-m-d').' 00:00:00')->where('moviles_id', $movil->id)->where('fin', null)->first();
                $conteoRecorridos = Recorridos::where('created_at', '>=', date('Y-m-d').' 00:00:00')->where('moviles_id', $movil->id)->count();
                $viaje = 1;
                if($conteoRecorridos){
                    if($ultimoRecorrido){
                        $viaje = $ultimoRecorrido->viaje;
                    }else{
                        $viaje = 2;
                    }
                }
                
                $plan = Planes::where('fecha', now())->first();
                $planMovil = DB::table('choferes_moviles_planes')->where('moviles_id', $movil->id)->where('planes_id', $plan->id)->where('viaje', $viaje)->first();

                if($planMovil){

                    $recorrido = new Recorridos();
                    $recorrido->moviles_id = $movil->id;
                    $recorrido->choferes_id = $planMovil->choferes_id;
                    $recorrido->sensores_id = $sensor->id;
                    $recorrido->puntos_id = $sensor->puntos->id;
                    $recorrido->tiers_id = $movil->tiers_id;
                    $recorrido->inicio = $fechaHoraAct;
                    $recorrido->viaje = $viaje;

                    $actPunto = Puntos::find($sensor->puntos_id);
                    foreach($actPunto->tiers as $tier){
                        if($tier->id == $movil->tiers_id){
                            $recorrido->target = $this->addTime($tier->pivot->target, $fechaHoraAct);
                            $recorrido->ponderacion = $this->addTime($tier->pivot->ponderacion, $recorrido->target);
                            
                            if($recorrido->target == $recorrido->inicio && $recorrido->ponderacion == $recorrido->inicio){
                                $recorrido->fin = $fechaHoraAct;
                            }
                            break;
                        }
                    }

                    if($ultimoRecorrido){
                        $recorrido->recorridos_id = $ultimoRecorrido->id;

                        $ultimoRecorrido->fin = $fechaHoraAct;
                        $ultimoRecorrido->save();

                        if($ultimoRecorrido->estado == 'OutOfTime'){
                            $a = Alertas::where('recorridos_id', $ultimoRecorrido->id)->first();
                            if($a->users_id == null && $a->inicio == null){
                                $a->visible = false;
                                $a->inicio = $a->inicio ? $a->inicio : $fechaHoraAct;
                                $a->fin = $fechaHoraAct;
                                $a->observaciones = 'Alerta eliminada por Punto de control alcanzado';
                                $a->save();
                            }
                        }
                    }

                    $recorrido->save();

                    return $recorrido;
                }
                return response()->json([ 'mensaje' => 'Movil no se encuentra en la planificación de hoy' ]);
            }
            return response()->json([ 'mensaje' => 'Movil o Sensor no se encuentran en la base' ]);
        }
        return response()->json([ 'mensaje' => 'Horario no permitido para la planificación' ]);
        
    }


    private function addTime($time, $ahora = false){
        $div = explode(':', $time);

        $date = $ahora ? $ahora : date('Y-m-d H:i:s');

        $res = date('Y-m-d H:i:s', strtotime($date.' +'.$div[0].' hours'));
        $res = date('Y-m-d H:i:s', strtotime($res.' +'.$div[1].' minutes'));
        $res = date('Y-m-d H:i:s', strtotime($res.' +'.$div[2].' seconds'));

        return $res;
    }
}
