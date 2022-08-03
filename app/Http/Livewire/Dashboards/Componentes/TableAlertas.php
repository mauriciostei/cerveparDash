<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Models\Alertas;
use DateTime;
use Livewire\Component;
use Livewire\WithPagination;

class TableAlertas extends Component
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

    public function difTime($time){
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($time);
        $interval = $datetime1->diff($datetime2);
        $elapsed = $interval->format('%H:%I:%S');

        return $elapsed;
    }

    public function render(){
        return view('livewire.dashboards.componentes.table-alertas', [
            'alertas' => Alertas::select('alertas.*')
                ->join('recorridos', 'alertas.recorridos_id', '=', 'recorridos.id')
                ->whereIn('tiers_id', $this->tiers)
                ->whereDate('alertas.inicio', '>=', $this->desde)
                ->whereDate('alertas.inicio', '<=', $this->hasta)
                ->orderBy('id', 'desc')
                ->paginate(10)
        ]);
    }
}
