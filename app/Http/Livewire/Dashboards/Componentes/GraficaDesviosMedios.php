<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficaDesviosMedios extends Component
{
    public $desde;
    public $hasta;
    public $tiers;
    public $desvioMedio;

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

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.grafica-desvios-medios');
    }

    public function getInfo(){

        $ini = $this->desde;
        $fin = $this->hasta;
        $tiers = implode(',', $this->tiers);

        $desvioMedio = collect(DB::select("select * from desvio_medio(?, ?) where tier_id in (".$tiers.")", [$ini, $fin]));

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

        $this->emit('updateGraficoDesviosMedios', $this->desvioMedio);
    }
}
