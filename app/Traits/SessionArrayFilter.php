<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait SessionArrayFilter{

    private function sessionToArray($seccion){
        $se = session($seccion);

        if(!isset($se)){
            switch($seccion){
                case 'selectedTiers': $se = DB::table('tiers')->pluck('id'); break;
                case 'selectedSitio': $se = DB::table('puntos')->pluck('id'); break;
                case 'selectedMóviles': $se = DB::table('moviles')->pluck('id'); break;
                case 'selectedChofer': $se = DB::table('choferes')->pluck('id'); break;
            }
            return $se;
        }

        $filtered_array = array_filter($se, function ($var) {
            return ($var == true);
        });
        return array_keys($filtered_array);
    }
    
}