<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Models\Alertas;
use DateTime;
use Livewire\Component;
use Livewire\WithPagination;

class TablaTMAGeneral extends Component
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

    public function difTime($time){
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($time);
        $interval = $datetime1->diff($datetime2);
        $elapsed = $interval->format('%H:%I:%S');

        return $elapsed;
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
        $alertas = Alertas::where('tipos_alertas_id', 2)->orderBy('id', 'DESC')->take(2000)->get();

        $fileName = 'HistorialAlertas.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel;",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Expires"             => "0"
        );

        $columns = array(
            'Movil'
            , 'Chofer'
            , 'Hora Detectada'
            , 'Hora Fin'
            , 'Causa'
            , 'Trabajado por'
            , 'Observaciones'
        );

        $callback = function() use($alertas, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,"\t");

            foreach ($alertas as $m) {

                $linea = array(
                    $m->recorridos->moviles->nombre
                    , $m->recorridos->choferes->nombre
                    , $m->created_at
                    , $m->fin ? $m->fin : $this->difTime($m->created_at)
                    , $m->causas_id ? $m->causas->nombre : '-'
                    , $m->users_id ? $m->users->name : '-'
                    , $m->observaciones
                );
                fputcsv($file, $linea,"\t");
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
