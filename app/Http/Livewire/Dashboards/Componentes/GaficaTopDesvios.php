<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GaficaTopDesvios extends Component
{
    public $desde;
    public $hasta;
    public $tiers;
    public $topDesvios;

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

        $this->topDesvios = collect(DB::select("select * from top_desvios(?, ?, 5) where tier_id in (".$tiers.")", [$ini, $fin]));

        $labels = [];
        $t1 = [];
        $t2 = [];
        foreach($this->topDesvios as $td){
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

        $this->emit('updateGraficoTopDesvios', $this->topDesvios);
    }


    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.gafica-top-desvios');
    }
}
