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

            $letras = substr($chapa,0,-3);
            $numeros = substr($chapa,-3);
            /*verificamos si son letras los primeros 4 y numeros los 3 ultimos*/
            if(ctype_alpha($letras) && ctype_digit($numeros)){
                /*la chapa esta sin errores*/
            }
            /*si tiene letras o numeros en donde no van*/
            elseif((!ctype_alpha($letras)||!ctype_digit($numeros))&& $chapa !="unknown" && $chapa != "######"){
                    if((substr($chapa,-1))=='#'){
                    }else{
                        /*Reemplazar seccion incorrecta en los errores ya conocidos*/

                        /*-------------Hallar la chapa que mas se aproxima en la bd----------------------------*/
                        // aún no se ha encontrado la distancia más corta
                        $closest = 'nada';
                        $shortest = -1;
                        $moviles= Moviles::all();
                        // bucle a través de las palabras para encontrar la más cercana
                        foreach ($moviles as $movil) {
                            // calcula la distancia entre la palabra de entrada
                            // y la palabra actual
                            $lev = levenshtein($chapa,$movil->chapa);
                            // verifica por una coincidencia exacta
                            if ($lev == 0) {
                                // la palabra más cercana es esta (coincidencia exacta)
                                $closest = $movil->chapa;
                                $shortest = 0;
                                // salir del bucle ya que se ha encontrado una coincidencia exacta
                                break;
                            }
                            // si esta distancia es menor que la siguiente distancia
                            // más corta o si una siguiente palabra más corta aun no se ha encontrado
                            if (($lev <= $shortest || $shortest < 0) && ( $lev < 3 )) {
                                // establece la coincidencia más cercana y la distancia más corta
                                $closest  = $movil->chapa;
                                $shortest = $lev;
                            }
                        }
                        /*retornamos la chapa que mas se aproximo */
                            /*que solo haga el cambio si shortest es menor a tres*/
                            if($shortest < 3){
                                    $chapa = $closest;
                            }

                    }
            }


            $movil = Moviles::where('activo', true)->where(function($query) use($chapa){
                $query->where('chapa', $chapa)
                    ->orWhere('chapa_trasera', $chapa);
            })->first();
    
            if($sensor && $movil){
                if($movil->tiers_id==1 || (date('H')>=5 && date('H')<=21)){
                    $fechaHora = date('Y-m-d H:i:s');

                    $ruta = Recorridos::whereDate('inicio', date('Y-m-d'))->where('moviles_id', $movil->id)->where('puntos_id', env('PUNTO_INICIO'))->first();
                    if(!$ruta && $movil->tiers_id==2 && $sensor->puntos_id != env('PUNTO_INICIO')){
                        return response()->json(["mensaje" => "Aun no se alcanzo el punto de inicio"]);
                    }

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
