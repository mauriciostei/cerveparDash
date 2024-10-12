<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait BioStarData{

    public function getData($inicio, $fin, $limit = 50){

        // Captar variables de entorno
        $url = env('SW_URL');
        $user = env("SW_USER");
        $pass = env("SW_PASS");
        $evento = env("SW_EVENT");

        // Ingresar usuario al sistema y obtener token
        $request = Http::withBody('{"User":{"login_id":"'.$user.'","password":"'.$pass.'"}}', "application/json")
        ->withoutVerifying()
        ->withHeaders([
            'accept' => 'application/json'
        ])
        ->post($url."login");

        $request->onError(function(){
          return null;
        });

        $token = $request->headers()['bs-session-id'][0];

        // Obtener lista de usuarios Leidos en 5 segundos
        $request = Http::
        withBody('
        {
            "Query": {
              "limit": '.$limit.',
              "conditions": [
                {
                  "column": "datetime",
                  "operator": 3,
                  "values": [
                    "'.$this->setTime($inicio).'",
                    "'.$this->setTime($fin).'"
                  ]
                },
                {
                  "column": "event_type_id.code",
                  "operator": 2,
                  "values": '.$evento.'
                },
                {
                  "column": "user_id.user_id",
                  "operator": 1,
                  "values": ["1"]
                }
              ],
              "orders": [
                {
                  "column": "datetime",
                  "descending": false
                }
              ]
            }
          }
        ', 'application/json')
        ->withoutVerifying()
        ->withHeaders([
            'accept' => 'application/json',
            'bs-session-id' => $token,
        ])
        ->post($url."events/search");

        $request->onError(function(){
          return null;
        });

        // Eliminar el token de la aplicación
        Http::withoutVerifying()->withHeaders(['bs-session-id' => $token])->post($url."logout");

        $request->onError(function(){
          return null;
        });

        if($request->successful()){
            $response = json_decode($request->body());
            return $response->EventCollection->rows;
        }else{
            return null;
        }
    }

    private function setTime($time){
      return date("Y-m-d", strtotime("$time"))."T".date("H:i:s.v", strtotime("$time"))."Z";
    }

}