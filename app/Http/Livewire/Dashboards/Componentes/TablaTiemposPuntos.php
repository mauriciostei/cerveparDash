<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Models\Recorridos;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaTiemposPuntos extends Component
{
    public $desde;
    public $hasta;
    public $tiers;

    public $puntos;

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

        $this->puntos = Recorridos::
            select(
                'puntos.nombre'
                , DB::raw("COALESCE(avg(case when tiers_id = 1 then fin-inicio end), '00:00:00') t1")
                , DB::raw("COALESCE(avg(case when tiers_id = 2 then fin-inicio end), '00:00:00') t2")
                , DB::raw("avg(fin-inicio) general")
                )
            ->join('puntos', 'recorridos.puntos_id', '=', 'puntos.id')
            ->whereNotNull('fin')
            ->whereIn('recorridos.tiers_id', $this->tiers)
            ->whereDate('inicio', '>=', $ini)
            ->whereDate('inicio', '<=', $fin)
            ->where('puntos.id', '<>', 6)
            ->groupBy('puntos.nombre')
            ->get()
        ;
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-tiempos-puntos');
    }
}
