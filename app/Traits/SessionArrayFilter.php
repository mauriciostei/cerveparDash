<?php

namespace App\Traits;

trait SessionArrayFilter{

    private function sessionToArray($seccion){
        $se = session($seccion) ?? [];

        $filtered_array = array_filter($se, function ($var) {
            return ($var == true);
        });
        return array_keys($filtered_array);
    }
    
}