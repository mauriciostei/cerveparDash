<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Models\Puntos;
use App\Models\Recorridos;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TiemposFinancieros extends Component
{
    public $desde;
    public $hasta;
    public $tiers;

    public $tf;

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

        $puntos = Puntos::where('tiempos_financieros', True)->pluck('id')->toArray();
        $recorridos = Recorridos::whereIn('puntos_id', $puntos)
            ->whereNotNull('fin')
            ->whereIn('recorridos.tiers_id', $this->tiers)
            ->whereDate('inicio', '>=', $ini)
            ->whereDate('inicio', '<=', $fin)
            ->avg(DB::raw(' fin - inicio '))
        ;

        $this->tf = $recorridos ?? '00:00:00';
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.componentes.tiempos-financieros');
    }
}
