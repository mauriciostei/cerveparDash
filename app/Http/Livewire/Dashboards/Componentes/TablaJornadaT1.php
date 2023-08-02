<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Traits\CalculateColorT1;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaJornadaT1 extends Component
{
    use CalculateColorT1;

    public $desde;
    public $hasta;
    public $tiers;

    public $jornada;

    protected $listeners = ['actualizarJornada'];

    public function mount(){
        $this->tiers = [1];
    }

    public function actualizarJornada($datos){
        $this->desde = $datos['desde'];
        $this->hasta = $datos['hasta'];
    }

    public function exportar(){
        $jornada = $this->jornada;

        $fileName = 'JornadaT1.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel;",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Expires"             => "0"
        );

        $columns = array(
            'Tiers'
            , 'Fecha'
            , 'Chofer'
            , 'Movil'
            , 'T. Espera'
            , 'T. Atendimiento'
            , 'Permanencia'
        );

        $callback = function() use($jornada, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,"\t");

            foreach ($jornada as $item) {
                $linea = array(
                    $item['tiers_nombre'],
                    $item['fecha'],
                    $item['chofer_nombre'],
                    $item['movil_nombre'],
                    $item['espera'],
                    $item['atendimiento'],
                    $item['ttotal']
                );
                fputcsv($file, $linea,"\t");
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getInfo(){
        $this->jornada = DB::table('recorridos')->select([
            'recorridos.tiers_id'
            , 'tiers.nombre as tiers_nombre'
            , 'recorridos.viaje'
            , 'recorridos.choferes_id'
            , 'choferes.nombre as chofer_nombre'
            , 'moviles.nombre as movil_nombre'
            , DB::raw("cast(recorridos.inicio as date) as fecha")
            , DB::raw("sum( case when puntos.id in (".env('ESPERA').") then fin-inicio else '00:00:00' end ) espera")
            , DB::raw("sum( case when puntos.id in (".env('ATENDIMIENTO').") then fin-inicio else '00:00:00' end ) atendimiento")
            , DB::raw("sum( fin-inicio ) ttotal")
        ])
            ->join('puntos', 'recorridos.puntos_id', '=', 'puntos.id')
            ->join('tiers', 'tiers.id', '=', 'recorridos.tiers_id')
            ->join('choferes', 'choferes.id', '=', 'recorridos.choferes_id')
            ->join('moviles', 'moviles.id', '=', 'recorridos.moviles_id')
            ->whereNotNull('recorridos.fin')
            ->whereIn('recorridos.tiers_id', $this->tiers)
            ->whereDate('recorridos.inicio', '>=', $this->desde)
            ->whereDate('recorridos.inicio', '<=', $this->hasta)
            ->groupByRaw("cast(recorridos.inicio as date)")
            ->groupBy(['recorridos.tiers_id', 'tiers.nombre', 'recorridos.viaje', 'recorridos.choferes_id', 'choferes.nombre', 'moviles.nombre'])
            ->get();
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-jornada-t1');
    }
}
