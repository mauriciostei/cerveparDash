<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Choferes;
use App\Models\Moviles;
use App\Models\Recorridos;
use App\Models\Sensores;
use App\Traits\BioStarData;
use App\Traits\NuevoRecorrido;
use App\Traits\XMLToJSON;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RecorridosController extends Controller
{
    use BioStarData;
    use XMLToJSON;
    use NuevoRecorrido;

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

        if($recorrido){
            foreach($recorrido as $r){
                $r->estado = 'No Tratada';
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
            $a->fin = now();
            $a->observaciones = 'Alerta eliminada por cambio de dia';
            $a->save();

            $r = $a->recorridos;
            $r->estado = 'No Tratada';
            $r->save();
        }
    }


    public function ingresarMovil(Request $request){
        $xml = $this->xmlToJson($request);

        if($xml){
            $direccion = $xml->ANPR->direction;
            $sensor = Sensores::where('codigo', $xml->channelName)
                ->where('activo', true)
                ->where(function($query) use($direccion){
                    $query->where('direccion', $direccion)->orWhere('direccion', 'Todas');
                })
                ->first();

            $chapa = $xml->ANPR->licensePlate;
            $movil = Moviles::where('activo', true)->where(function($query) use($chapa){
                $query->where('chapa', $chapa)
                    ->orWhere('chapa_trasera', $chapa);
            })->first();
    
            if($sensor && $movil){
                if($movil->tiers_id==1 || (date('H')>=5 && date('H')<=21)){
                    $fechaHora = date('Y-m-d H:i:s');
                    $this->ingresarRecorrido($sensor, $movil->tiers_id, 'moviles_id', $movil->id, $fechaHora);
                    return response()->json(["mensaje" => "Datos ingresado con exito"]);
                }
            }
        }
    }


    public function ingresarPersona($inicio, $fin){

        $response = $this->getData($inicio, $fin);

        if($response){

            foreach($response as $item):
    
                $sensor = Sensores::where('codigo', $item->device_id->id)->where('activo', true)->first();
                $chofer = Choferes::where('documento', $item->user_id->user_id)->where('activo', true)->first();

                if($sensor && $chofer){
                    if($chofer->tiers_id==1 || (date('H')>=5 && date('H')<=21)){
                        $fechaHora = date('Y-m-d H:i:s', strtotime($item->datetime));;
                        $this->ingresarRecorrido($sensor, $chofer->tiers_id, 'choferes_id', $chofer->id, $fechaHora);
                    }
                }
    
            endforeach;
        }
    }
}
