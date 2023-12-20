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
use Illuminate\Support\Facades\DB;
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
                $a->tipos_alertas_id = 1;
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

                $a = Alertas::where('recorridos_id', $r->id)->where('tipos_alertas_id', 1)->first();
                $a->visible = false;
                $a->fin = now();
                $a->observaciones = 'Alerta eliminada por sobrepaso de Ponderación';
                $a->save();
            }
        }
    }


    public function validarAlertas(){
        $alertas = Alertas::where('created_at', '<', date('Y-m-d').' 00:00:00')->whereNull('users_id')->whereNull('fin')->where('tipos_alertas_id', 1)->get();
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

    public function alertasTMA(){
        $generar = DB::table('public.alertas_tma')->get();
        foreach($generar as $reco):
            $al = new Alertas();
            $al->recorridos_id = $reco->recorrido;
            $al->tipos_alertas_id = 2;
            $al->save();
        endforeach;
    }


    public function ingresarMovil(Request $request){
        $xml = $this->xmlToJson($request);

        if($xml){
            $direccion = $xml->ANPR->direction;

            $query = Sensores::query()->where('codigo', $xml->channelName)->where('activo', true);
            if(trim($direccion) !== 'unknown'){
                $query->where(function($query) use($direccion){
                    $query->where('direccion', $direccion)->orWhere('direccion', 'Todas');
                });
            }
            $sensor = $query->first();

            $chapa = $xml->ANPR->licensePlate;

            /* array para contar cuantas chapas se aproximaron con $lev in(0,1,2) */
            $count =array(
                0 => 0,
                1 => 0,
                2 => 0,
            );
            $count2 =array(
                0 => 0,
                1 => 0,
                2 => 0,
            );
            /*si vienen valores desconocidos o que no se pueden hallar*/
            if( $chapa !="unknown" && $chapa != "######"){
                /*verifica que el ultimo caracter no sea # */
                if((substr($chapa,-1))=='#'){
                        Log::info('No se puede encontrar el numero numero de la chapa');
                }else{
                    /*Reemplazar seccion incorrecta en los errores ya conocidos*/

                    /*-------------Hallar la chapa que mas se aproxima en la bd----------------------------*/
                    // aÃºn no se ha encontrado la distancia mÃ¡s corta
                    $closest = 'nada';
                    $closest2 = 'nada';
                    $shortest = -1;
                    $shortest2 = -1;
                    $moviles= Moviles::all();
                    // bucle a travÃ©s de las palabras para encontrar la mÃ¡s cercana
                    foreach ($moviles as $movil) {
                        // calcula la distancia entre la palabra de entrada
                        // y la palabra actual

                        $lev = levenshtein($chapa,$movil->chapa);
                        $lev2 = levenshtein($chapa,$movil->chapa_trasera);

                        // verifica por una coincidencia exacta
                        if ($lev == 0) {
                            // la palabra mÃ¡s cercana es esta (coincidencia exacta)
                            $closest = $movil->chapa;
                            $shortest = 0;
                            // salir del bucle ya que se ha encontrado una coincidencia exacta
                            break;
                        }

                        // verifica por una coincidencia exacta
                        if ($lev2 == 0) {
                            // la palabra mÃ¡s cercana es esta (coincidencia exacta)
                            $closest2 = $movil->chapa_trasera;
                            $shortest2 = 0;
                            // salir del bucle ya que se ha encontrado una coincidencia exacta
                            break;
                        }
                        // si esta distancia es menor que la siguiente distancia
                        // mÃ¡s corta o si una siguiente palabra mÃ¡s corta aun no se ha encontrado
                        if (($lev <= $shortest || $shortest < 0) && ( $lev < 2 )) {
                            // establece la coincidencia mÃ¡s cercana y la distancia mÃ¡s corta
                            $closest  = $movil->chapa;
                            $shortest = $lev;
                            $count[$lev]++;
                        }
                         if (($lev2 <= $shortest2 || $shortest2 < 0) && ( $lev2 < 2 )) {
                            // establece la coincidencia mÃ¡s cercana y la distancia mÃ¡s corta
                            $closest2  = $movil->chapa_trasera;
                            $shortest2 = $lev2;
                            $count2[$lev2]++;
                        }
                    }
                    /*retornamos la chapa que mas se aproximo */
                    Log::info('--El ingresado es:'.$chapa);
                    /*si shortest es menor a 3 se tomas las aproximaciones con 2 cambios posibles para disminuir los errores
                    si count es uno solo hay una aproximacion posible
                    */
                    if(($shortest < 2 && $shortest !=-1 && $count[$shortest] == 1) || ($shortest2 < 2 && $shortest2 !=-1 && $count2[$shortest2] == 1)){
                            if($shortest>$shortest2 && $shortest2 !=-1){
                               $closest=$closest2;
                            }
                            $chapa = $closest;
                            Log::info('--El mas cercano es $Closest:'. $closest);
                    }
                }
            }

            $movil = Moviles::where('activo', true)->where(function($query) use($chapa){
                $query->where('chapa', $chapa)
                    ->orWhere('chapa_trasera', $chapa);
            })->first();

            if(is_null($movil)){
                Log::info("el movil to string vino NULL");
            }else{
                Log::info('movil con to_string:'.$movil->nombre);
            }
    
            if($sensor && $movil){
                if($movil->tiers_id==1 || (date('H')>=4 && date('H')<=23)){
                    $fechaHora = date('Y-m-d H:i:s');

                    $ruta = Recorridos::whereDate('inicio', date('Y-m-d'))->where('moviles_id', $movil->id)->where('puntos_id', env('PUNTO_INICIO'))->first();
                    if(!$ruta && $movil->tiers_id==2 && $sensor->puntos_id != env('PUNTO_INICIO')){
                        return response()->json(["mensaje" => "Aun no se alcanzo el punto de inicio"]);
                    }

                    $resultado = $this->ingresarRecorrido($sensor, $movil->tiers_id, 'moviles_id', $movil->id, $fechaHora);
                    if($resultado){
                        return response()->json(["mensaje" => "Datos ingresado con éxito"]);
                    }else{
                        return response()->json(["mensaje" => "Recorrido no cumple con los requisitos para el guardado"]);
                    }
                }else{
                    return response()->json(["mensaje" => "Fuera de horario para la captación T2"]);
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
                    if($chofer->tiers_id==1 || (date('H')>=4 && date('H')<=23)){
                        $fechaHora = date('Y-m-d H:i:s', strtotime($item->datetime));;
                        $this->ingresarRecorrido($sensor, $chofer->tiers_id, 'choferes_id', $chofer->id, $fechaHora);
                    }
                }
    
            endforeach;
        }
    }
}
