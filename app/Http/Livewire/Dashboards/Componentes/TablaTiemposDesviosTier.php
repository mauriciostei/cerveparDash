<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Models\Recorridos;
use App\Traits\MetricasPorcentajeHTML;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaTiemposDesviosTier extends Component
{
    use MetricasPorcentajeHTML;

    public $desde;
    public $hasta;
    public $tiers;

    public $resumenPuntos;

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

        $this->resumenPuntos = Recorridos::
            select(
                'puntos.nombre'
                , DB::raw("sum(case when tiers_id = 1 then 1 else 0 end) as cantidad_t1")
                , DB::raw("sum(case when tiers_id = 1 and estado = 'OutOfTime' then 1 else 0 end) oot_t1")
                , DB::raw("sum(case when tiers_id = 2 then 1 else 0 end) as cantidad_t2")
                , DB::raw("sum(case when tiers_id = 2 and estado = 'OutOfTime' then 1 else 0 end) oot_t2")
                )
            ->join('puntos', 'recorridos.puntos_id', '=', 'puntos.id')
            ->whereIn('recorridos.tiers_id', $this->tiers)
            ->whereDate('inicio', '>=', $ini)
            ->whereDate('inicio', '<=', $fin)
            ->groupBy('puntos.nombre')
            ->get()
        ;
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-tiempos-desvios-tier');
    }
}
