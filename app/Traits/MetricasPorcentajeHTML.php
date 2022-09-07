<?php

namespace App\Traits;

trait MetricasPorcentajeHTML{

    public function getPorcentaje($oot, $cantidad){
        $valor = 0;
        if($cantidad > 0 && $oot > 0){
            $valor = ($oot / $cantidad) * 100;
        }
        $valor = round($valor , 0);

        return $valor;
    }

    public function getHTML($oot, $cantidad){
        $valor = $this->getPorcentaje($oot, $cantidad);

        $color = '';

        if($valor > 50)
            $color = 'bg-red';
        if($valor <= 50 && $valor > 25)
            $color = 'bg-warning';
        if($valor <= 25 && $valor > 10)
            $color = 'bg-yellow';
        if($valor <= 10)
            $color = 'bg-success';

        $res = "<td><div class='".$color."'><div class='text-center text-dark'>".$valor."% </div></div></td>";

        echo $res;
    }

}