<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait TurnoJornadaT1{

    private function getInicio($movil, $chofer, $viaje, $fecha){
        $result = DB::table('recorridos')
            ->select( DB::raw('min(inicio) as fecha') )
            ->whereDate('inicio', $fecha)
            ->where('moviles_id', $movil)
            ->where('choferes_id', $chofer)
            ->where('viaje', $viaje)
            ->first()
        ;
        return $result->fecha;
    }

    public function getTurno($movil, $chofer, $viaje, $fecha){
        $fecha = $this->getInicio($movil, $chofer, $viaje, $fecha);
        $hora = date('H:i:s', strtotime($fecha));

        $result = 'Noche';

        switch($hora){
            case ($hora > '22:00:00' && $hora <= '23:59:59'): $result = 'Noche'; break;
            case ($hora > '00:00:01' && $hora <= '06:00:00'): $result = 'Noche'; break;
            case ($hora > '06:00:00' && $hora <= '14:00:00'): $result = 'Mañana'; break;
            case ($hora > '14:00:00' && $hora <= '22:00:00'): $result = 'Tarde'; break;
            default: $result = 'Noche';
        }

        return $result;
    }
    
}