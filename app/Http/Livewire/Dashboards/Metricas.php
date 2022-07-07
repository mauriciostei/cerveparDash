<?php

namespace App\Http\Livewire\Dashboards;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Metricas extends Component
{
    public $desde;
    public $hasta;
    public $tiers = ['1' => true, '2' => true];

    public $ingresoHora;
    public $desvioMedio;
    public $topDesvios;
    public $cantidadAnomalias;

    public function mount(){
        $this->desde = date('Y-m-d');
        $this->hasta = date('Y-m-d');
    }


    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.metricas');
    }

    public function getInfo(){

        $ini = $this->desde;
        $fin = $this->hasta;
        $tiers = '0';
        $tiers = $this->tiers[1] ? $tiers.',1' : $tiers;
        $tiers = $this->tiers[2] ? $tiers.',2' : $tiers;

        $ingresoHora = collect(DB::select("select * from ingreso_x_hora(?, ?) where id in (".$tiers.")", [$ini, $fin]));
        $desvioMedio = collect(DB::select("select * from desvio_medio(?, ?) where tier_id in (".$tiers.")", [$ini, $fin]));
        $topDesvios = collect(DB::select("select * from top_desvios(?, ?, 5) where tier_id in (".$tiers.")", [$ini, $fin]));
        $cantidadAnomalias = collect(DB::select("select * from cantidad_anomalias(?, ?) where id in (".$tiers.")", [$ini, $fin]));

        $labels = [];
        $t1 = [];
        $t2 = [];
        foreach($ingresoHora as $ih){
            $ini = explode(':', $ih->ini);
            $fin = explode(':', $ih->fin);
            $hora = $ini[0].' a '.$fin[0];
            if(!in_array($hora, $labels)){
                array_push($labels, $ini[0].' a '.$fin[0]);
            }
            if($ih->id == 1){
                array_push($t1, $ih->moviles);
            }else{
                array_push($t2, $ih->moviles);
            }
        }
        $this->ingresoHora = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tier 1', 'data' => $t1, 'backgroundColor' => '#37CBFF'),
            Array('label' => 'Tier 2', 'data' => $t2, 'backgroundColor' => '#F6AB16')
        ]);

        $labels = [];
        $t1 = [];
        $t2 = [];
        foreach($desvioMedio as $dm){
            if(!in_array($dm->punto_nombre, $labels)){
                array_push($labels, $dm->punto_nombre);
            }
            if($dm->tier_id == 1){
                array_push($t1, $dm->desvio);
            }else{
                array_push($t2, $dm->desvio);
            }
        }
        $this->desvioMedio = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tier 1', 'data' => $t1, 'backgroundColor' => '#37CBFF'),
            Array('label' => 'Tier 2', 'data' => $t2, 'backgroundColor' => '#F6AB16')
        ]);

        $labels = [];
        $t1 = [];
        $t2 = [];
        foreach($topDesvios as $td){
            if(!in_array($td->movil_nombre, $labels)){
                array_push($labels, $td->movil_nombre);
            }
            if($td->tier_id == 1){
                array_push($t1, $td->hora);
            }else{
                array_push($t2, $td->hora);
            }
        }
        $this->topDesvios = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tier 1', 'data' => $t1, 'backgroundColor' => '#37CBFF'),
            Array('label' => 'Tier 2', 'data' => $t2, 'backgroundColor' => '#F6AB16')
        ]);

        $labels = [];
        $t1 = [];
        $t2 = [];
        foreach($cantidadAnomalias as $ca){
            $ini = explode(':', $ca->ini);
            $fin = explode(':', $ca->fin);
            $hora = $ini[0].' a '.$fin[0];
            if(!in_array($hora, $labels)){
                array_push($labels, $ini[0].' a '.$fin[0]);
            }
            if($ca->id == 1){
                array_push($t1, $ca->cantidad);
            }else{
                array_push($t2, $ca->cantidad);
            }
        }
        $this->cantidadAnomalias = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tier 1', 'data' => $t1, 'backgroundColor' => '#37CBFF'),
            Array('label' => 'Tier 2', 'data' => $t2, 'backgroundColor' => '#F6AB16')
        ]);

        $this->emit('updateGraph', $this->ingresoHora, $this->desvioMedio, $this->topDesvios, $this->cantidadAnomalias);
    }
}
