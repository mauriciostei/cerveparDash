<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficaDescargaDock extends Component
{
    public $desde;
    public $hasta;
    public $tiers;
    public $descargaDock;

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

        $descargaDock = DB::table('recorridos')
            ->select(
                'sensores.nombre'
                , DB::raw("extract(minutes from COALESCE(avg(case when tiers_id = 1 then fin-inicio end), '00:00:00')) t1")
                , DB::raw("extract(minutes from COALESCE(avg(case when tiers_id = 2 then fin-inicio end), '00:00:00')) t2")
                )
            ->join('sensores', 'recorridos.sensores_id', '=', 'sensores.id')
            ->where('recorridos.puntos_id', '=', 4)
            ->whereNotNull('fin')
            ->whereIn('recorridos.tiers_id', $this->tiers)
            ->whereDate('inicio', '>=', $ini)
            ->whereDate('inicio', '<=', $fin)
            ->groupBy('sensores.nombre')
            ->get()
        ;

        $labels = [];
        $t1 = [];
        $t2 = [];
        foreach($descargaDock as $dm){
            array_push($labels, $dm->nombre);
            array_push($t1, $dm->t1);
            array_push($t2, $dm->t2);
        }
        $this->descargaDock = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tier 1', 'data' => $t1, 'backgroundColor' => '#37CBFF'),
            Array('label' => 'Tier 2', 'data' => $t2, 'backgroundColor' => '#F6AB16')
        ]);

        $max = $t2 ? max($t2) : 0;

        $this->emit('updateGraficoDescargaDock', $this->descargaDock, $max);
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.grafica-descarga-dock');
    }
}
