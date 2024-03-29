<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Models\Alertas;
use App\Traits\TimeToHour;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TableAlertasAgrupado extends Component
{
    use WithPagination;
    use TimeToHour;

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
            'alertas' => Alertas::select('problemas.nombre as problema_nombre', DB::raw('count(*) as cantidad') , 'puntos.nombre as punto_nombre', DB::raw('avg(alertas.fin - coalesce(alertas.inicio, alertas.created_at)) as tiempo_medio'))
                ->join('recorridos', 'alertas.recorridos_id', '=', 'recorridos.id')
                ->join('puntos', 'recorridos.puntos_id', '=', 'puntos.id')
                ->leftJoin('problemas', 'alertas.problemas_id', '=', 'problemas.id')
                ->where('alertas.tipos_alertas_id', 1)
                ->whereIn('tiers_id', $this->tiers)
                ->whereDate('alertas.created_at', '>=', $this->desde)
                ->whereDate('alertas.created_at', '<=', $this->hasta)
                ->groupBy('problemas.nombre', 'puntos.nombre')
                ->orderBy('problemas.nombre', 'desc')
                ->orderBy('puntos.nombre', 'desc')
                ->paginate(10)
        ]);
    }
}
