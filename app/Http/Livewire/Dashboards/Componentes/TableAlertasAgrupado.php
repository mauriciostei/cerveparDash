<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Models\Alertas;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TableAlertasAgrupado extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $desde;
    public $hasta;
    public $tiers;

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
        return view('livewire.dashboards.componentes.table-alertas-agrupado', [
            'alertas' => Alertas::select('problemas.nombre as problema_nombre', DB::raw('count(*) as cantidad') , 'puntos.nombre as punto_nombre', DB::raw('avg(alertas.fin - alertas.inicio) as tiempo_medio'))
                ->join('recorridos', 'alertas.recorridos_id', '=', 'recorridos.id')
                ->join('puntos', 'recorridos.puntos_id', '=', 'puntos.id')
                ->leftJoin('problemas', 'alertas.problemas_id', '=', 'problemas.id')
                ->whereIn('tiers_id', $this->tiers)
                ->whereDate('alertas.inicio', '>=', $this->desde)
                ->whereDate('alertas.inicio', '<=', $this->hasta)
                ->groupBy('problemas.nombre', 'puntos.nombre')
                ->orderBy('problemas.nombre', 'desc')
                ->orderBy('puntos.nombre', 'desc')
                ->paginate(10)
        ]);
    }
}
