<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Models\Alertas;
use App\Traits\CorrespondeViaje;
use App\Traits\DifTime;
use App\Traits\ExportarExcel;
use Livewire\Component;
use Livewire\WithPagination;

class TablaTMAGeneral extends Component
{
    use DifTime;
    use CorrespondeViaje;
    use ExportarExcel;

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

    public function historial(){
        $alertas = Alertas::where('tipos_alertas_id', 2)
            ->whereDate('alertas.created_at', '>=', $this->desde)
            ->whereDate('alertas.created_at', '<=', $this->hasta)
            ->orderBy('id', 'DESC')
            ->take(2000)
        ->get();

        $columns = array('Centro de Distribución', 'Movil', 'Chofer', 'Corresponde', 'Hora Detectada', 'Hora Fin', 'Causa Raíz', 'Causa General', 'Trabajado por', 'Observaciones');

        $datos = Array();
        foreach($alertas as $item):
            $datos[] = Array(
                env('LOCALIDAD')
                , $item->recorridos->moviles->nombre
                , $item->recorridos->choferes->nombre
                , $this->corresponde(
                    date('Y-m-d', strtotime($item->recorridos->inicio))
                    , $item->recorridos->moviles_id
                    , $item->recorridos->choferes_id
                    , $item->recorridos->viaje)
                , $item->created_at
                , $item->fin ? $item->fin : $this->difTime($item->created_at)
                , $item->causa_raizs_id ? $item->causasRaiz->nombre : '-'
                , $item->causas_id ? $item->causas->nombre : '-'
                , $item->users_id ? $item->users->name : '-'
                , $item->observaciones
            );
        endforeach;
        
        return $this->getFile('HistorialAlertas.xls', $columns, $datos);
    }

    public function render()
    {
        return view('livewire.dashboards.componentes.tabla-t-m-a-general', [
            'alertas' => Alertas::select('alertas.*')
                ->join('recorridos', 'alertas.recorridos_id', '=', 'recorridos.id')
                ->where('alertas.tipos_alertas_id', 2)
                ->whereIn('recorridos.tiers_id', $this->tiers)
                ->whereDate('alertas.created_at', '>=', $this->desde)
                ->whereDate('alertas.created_at', '<=', $this->hasta)
                ->orderBy('id', 'desc')
            ->paginate(10)
        ]);
    }
}
