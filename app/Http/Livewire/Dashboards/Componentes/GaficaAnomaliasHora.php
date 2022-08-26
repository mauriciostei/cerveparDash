<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GaficaAnomaliasHora extends Component
{
    public $desde;
    public $hasta;
    public $tiers;
    public $cantidadAnomalias;

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

        $this->cantidadAnomalias = collect(DB::select("select * from cantidad_anomalias(?, ?) where id in (".$tiers.")", [$ini, $fin]));

        $labels = [];
        $t1 = [];
        $t2 = [];
        foreach($this->cantidadAnomalias as $ca){
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

        $this->emit('updateGraficoAnomaliasHora', $this->cantidadAnomalias);
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.gafica-anomalias-hora');
    }
}
