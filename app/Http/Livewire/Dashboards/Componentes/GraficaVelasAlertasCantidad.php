<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficaVelasAlertasCantidad extends Component
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
        $cantidad = [];
        $media = [];
        foreach($velaAlertaTiempo as $dm){
            if(!in_array($dm->puntos_nombre, $labels)){
                array_push($labels, $dm->puntos_nombre);
            }
            if($dm->cantidad_min){
                array_push($cantidad, [$dm->cantidad_min, $dm->cantidad_max]);
                array_push($media, $dm->cantidad_avg);
            }
        }
        $this->velaAlertaTiempo = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Cantidad', 'data' => $cantidad, 'backgroundColor' => '#37CBFF', 'barPercentage' => 0.02, 'order' => 2),
            Array('label' => 'Media', 'data' => $media, 'type' => 'line', 'backgroundColor' => '#F6AB16', 'showLine' => false, 'pointRadius' => 4, 'order' => 1)
        ]);

        $this->emit('updateGraficoVelaCantidad', $this->velaAlertaTiempo);
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.grafica-velas-alertas-cantidad');
    }
}
