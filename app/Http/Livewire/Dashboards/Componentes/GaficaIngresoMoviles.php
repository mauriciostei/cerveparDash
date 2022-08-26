<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GaficaIngresoMoviles extends Component
{
    public $desde;
    public $hasta;
    public $tiers;
    public $ingresoHora;

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

        $this->ingresoHora = collect(DB::select("select * from ingreso_x_hora(?, ?) where id in (".$tiers.")", [$ini, $fin]));

        $labels = [];
        $t1 = [];
        $t2 = [];
        foreach($this->ingresoHora as $ih){
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

        $this->emit('updateGraficoIngresoMoviles', $this->ingresoHora);
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.gafica-ingreso-moviles');
    }
}
