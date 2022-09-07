<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficaVelasAlertasTiempo extends Component
{
    public $desde;
    public $hasta;
    public $tiers;
    public $velaAlertaTiempo;

    protected $listeners = ['actualizarTable'];

    public function mount(){
        $this->tiers = [1,2];
    }

    public function actualizarTable($datos){
        $this->desde = $datos['desde'];
        $this->hasta = $datos['hasta'];
        $this->tiers = [];
        foreach($datos['tiers'] as $index => $item):
            if($item){
                array_push($this->tiers, $index);
            }
        endforeach;
    }

    public function getInfo(){

        $ini = $this->desde;
        $fin = $this->hasta;
        $tiers = implode(',', $this->tiers) ? implode(',', $this->tiers) : '0';

        $velaAlertaTiempo = collect(DB::select("select * from grafico_velas(?, ?) where tiers_id in ($tiers)", [$ini, $fin]));

        $labels = [];
        $tiempo = [];
        $media = [];
        foreach($velaAlertaTiempo as $dm){

            $ini = strtotime($dm->tiempo_min);
            $end = strtotime($dm->tiempo_max);
            $avg = strtotime($dm->tiempo_avg);

            $ini = date('H', $ini).'.'.date('i', $ini);
            $end = date('H', $end).'.'.date('i', $end);
            $avg = date('H', $avg).'.'.date('i', $avg);

            if(!in_array($dm->puntos_nombre, $labels)){
                array_push($labels, $dm->puntos_nombre);
            }
            if($dm->cantidad_min){
                array_push($tiempo, [$ini, $end]);
                array_push($media, $avg);
            }
        }
        $this->velaAlertaTiempo = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tiempo', 'data' => $tiempo, 'backgroundColor' => '#37CBFF', 'barPercentage' => 0.02, 'order' => 2),
            Array('label' => 'Media', 'data' => $media, 'type' => 'line', 'backgroundColor' => '#F6AB16', 'showLine' => false, 'pointRadius' => 4, 'order' => 1)
        ]);

        $this->emit('updateGraficoVelaTiempo', $this->velaAlertaTiempo);
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.grafica-velas-alertas-tiempo');
    }
}
