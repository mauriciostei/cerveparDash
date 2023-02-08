<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaJornada extends Component
{
    public $desde;
    public $hasta;
    public $tiers;

    public $jornada;

    protected $listeners = ['actualizarJornada'];

    public function mount(){
        $this->tiers = [2];
    }

    public function actualizarJornada($datos){
        $this->desde = $datos['desde'];
        $this->hasta = $datos['hasta'];
        $this->tiers = [];
        foreach($datos['tiers'] as $index => $item):
            if($item){
                array_push($this->tiers, $index);
            }
        endforeach;
    }

    public function exportar(){
        $jornada = $this->jornada;

        $fileName = 'Jornada.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel;",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Expires"             => "0"
        );

        $columns = array(
            'Tiers'
            , 'Chofer'
            , 'Movil'
            , 'TML'
            , 'TR'
            , 'T. Interno'
            , 'Liquidación'
            , 'Caja'
            , 'T. Financiero'
            , 'T. Warehouse'
            , 'T. de desplazamiento'
            , 'Jornada'
        );

        $callback = function() use($jornada, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,"\t");

            foreach ($jornada as $item) {
                $linea = array(
                    $item['tiers_nombre'],
                    $item['chofer_nombre'],
                    $item['movil_nombre'],
                    $item['tml'],
                    $item['tr'],
                    $item['tmi'],
                    $item['liquidacion'],
                    $item['caja'],
                    $item['tfinanciero'],
                    $item['warehouse'],
                    $item['desplazamiento'],
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
            , 'recorridos.choferes_id'
            , 'choferes.nombre as chofer_nombre'
            , 'recorridos.moviles_id'
            , 'moviles.nombre as movil_nombre'
            , DB::raw("sum( case when puntos.tipo_tiempo = 'tml' then fin-inicio else '00:00:00' end ) tml")
            , DB::raw("sum( case when puntos.tipo_tiempo = 'tmr' then fin-inicio else '00:00:00' end ) tr")
            , DB::raw("sum( case when puntos.tiempos_fisicos = True then fin-inicio else '00:00:00' end ) tfisico")
            , DB::raw("sum( case when puntos.tiempos_financieros = True then fin-inicio else '00:00:00' end ) tfinanciero")
            , DB::raw("sum( case when puntos.tipo_tiempo = 'tmi' then fin-inicio else '00:00:00' end ) tmi")
            , DB::raw("sum( case when puntos.id in (".env('LIQUIDACION').") then fin-inicio else '00:00:00' end ) liquidacion")
            , DB::raw("sum( case when puntos.id in (".env('CAJA').") then fin-inicio else '00:00:00' end ) caja")
            , DB::raw("sum( case when puntos.id in (".env('WAREHOUSE').") then fin-inicio else '00:00:00' end ) warehouse")
            , DB::raw("sum( case when puntos.id in (".env('DESPLAZAMIENTO').") then fin-inicio else '00:00:00' end ) desplazamiento")
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
            ->groupBy(['recorridos.tiers_id', 'tiers.nombre', 'recorridos.choferes_id', 'choferes.nombre', 'recorridos.moviles_id', 'moviles.nombre'])
            ->get();
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-jornada');
    }
}
