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

    public function historial(){
        $alertas = Alertas::where('tipos_alertas_id', 1)->orderBy('id', 'DESC')->take(2000)->get();

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
            , 'Zona'
            , 'Ultima cámara'
            , 'Hora Detectada'
            , 'Hora Fin'
            , 'Inicio Vs Tratamiento'
            , 'Tratamiento Vs Fin'
            , 'Anomalía'
            , 'Solución'
            , 'Resuelto por'
            , 'Estado'
            , 'Observaciones'
        );

        $callback = function() use($alertas, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,"\t");

            foreach ($alertas as $m) {

                $creado = new DateTime($m->created_at);
                $inicio = new DateTime($m->inicio);
                $fin = new DateTime($m->fin);

                $linea = array(
                    $m->recorridos->moviles->nombre
                    , '-'
                    , $m->recorridos->puntos->nombre
                    , $m->recorridos->sensores->nombre
                    , $m->created_at
                    , $m->fin ? $m->fin : $this->difTime($m->created_at)
                    , $m->inicio ? $creado->diff($inicio)->format('%H:%i:%s') : ''
                    , $m->inicio && $m->fin ? $inicio->diff($fin)->format('%H:%i:%s') : ''
                    , $m->problemas_id ? $m->problemas->nombre : '-'
                    , $m->soluciones_id ? $m->soluciones->nombre : '-'
                    , $m->users_id ? $m->users->name : '-'
                    , $m->getEstado()
                    , $m->observaciones
                );
                fputcsv($file, $linea,"\t");
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function render(){
        return view('livewire.dashboards.componentes.table-alertas', [
            'alertas' => Alertas::select('alertas.*')
                ->join('recorridos', 'alertas.recorridos_id', '=', 'recorridos.id')
                ->where('alertas.tipos_alertas_id', 1)
                ->whereIn('tiers_id', $this->tiers)
                ->whereDate('alertas.created_at', '>=', $this->desde)
                ->whereDate('alertas.created_at', '<=', $this->hasta)
                ->orderBy('id', 'desc')
                ->paginate(10)
        ]);
    }
}
