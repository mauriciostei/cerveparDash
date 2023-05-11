<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficaJornadaT1 extends Component
{
    public $desde;
    public $hasta;
    public $tiers;
    public $tma;

    protected $listeners = ['actualizarJornada'];

    public function mount(){
        $this->tiers = 1;
    }

    public function actualizarJornada($datos){
        $this->desde = $datos['desde'];
        $this->hasta = $datos['hasta'];
        $this->tiers = 1;
    }

    public function getInfo(){

        $ini = $this->desde;
        $fin = $this->hasta;
        $tier = $this->tiers;

        $tma = collect(DB::select("select * from tma('$ini', '$fin', $tier)"));

        $labels = [];
        $t1 = [];
        foreach($tma as $dm){
            array_push($t1, intval($dm->seconds));
            array_push($labels, "{$dm->turno}: {$dm->media}");
        }
        $this->tma = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Detalle', 'data' => $t1, 'backgroundColor' => '#37CBFF')
        ]);

        $this->emit('updateGraficoTMA', $this->tma);
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.componentes.grafica-jornada-t1');
    }
}
