<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Models\Alertas;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TableAlertasTop extends Component
{
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

    public function render()
    {
        $sinAsignar = Alertas::select(DB::raw("'Sin Asignar'"), DB::raw('count(*) as cantidad'), DB::raw('avg(alertas.fin - alertas.created_at) as tiempo_medio'))
            ->join('recorridos', 'alertas.recorridos_id', '=', 'recorridos.id')
            ->whereIn('tiers_id', $this->tiers)
            ->whereDate('alertas.created_at', '>=', $this->desde)
            ->whereDate('alertas.created_at', '<=', $this->hasta)
            ->where('alertas.problemas_id', null)
        ;

        $top5 = Alertas::select('problemas.nombre as problema_nombre', DB::raw('count(*) as cantidad'), DB::raw('avg(alertas.fin - alertas.inicio) as tiempo_medio'))
            ->join('recorridos', 'alertas.recorridos_id', '=', 'recorridos.id')
            ->join('problemas', 'alertas.problemas_id', '=', 'problemas.id')
            ->whereIn('tiers_id', $this->tiers)
            ->whereDate('alertas.created_at', '>=', $this->desde)
            ->whereDate('alertas.created_at', '<=', $this->hasta)
            ->groupBy('problemas.nombre')
            ->orderBy(DB::raw('count(*)'), 'desc')
            ->take(5)
            ->union($sinAsignar)
            ->get()
        ;

        return view('livewire.dashboards.componentes.table-alertas-top', [
            'alertas' => $top5
        ]);
    }
}
