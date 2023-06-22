<?php

namespace App\Traits;

trait CalculateColorT1{

    private function getColor($real, $escala){
        $real = date('H:i:s', strtotime($real));
        $escala = date('H:i:s', strtotime($escala));

        if($real == '00:00:00'){
            return 'bg-red';
        }

        return $real > $escala ? 'bg-red' : 'bg-success';
    }
    
}