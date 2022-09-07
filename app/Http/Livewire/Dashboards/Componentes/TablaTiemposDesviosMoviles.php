<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Models\Recorridos;
use App\Traits\MetricasPorcentajeHTML;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaTiemposDesviosMoviles extends Component
{
    use MetricasPorcentajeHTML;

    public $desde;
    public $hasta;
    public $tiers;

    public $resumenMoviles;

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

    public function descargar(){
        $fileName = 'Historial.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel;",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Expires"             => "0"
        );

        $columns = array(
            'Movil'
            ,'OOT En Ruta', 'OOT Control 1', 'OOT Control 2', 'OOT Envases', 'OOT Fin Envases', 'OOT Descarga', 'OOT Espera'
            ,'CANT. En Ruta', 'CANT. Control 1', 'CANT. Control 2', 'CANT. Envases', 'CANT. Fin Envases', 'CANT. Descarga', 'CANT. Espera'
            ,'% En Ruta', '% Control 1', '% Control 2', '% Envases', '% Fin Envases', '% Descarga', '% Espera'
            , 'Total OOT', 'Total Captados', 'Porcentaje Total OOT'
        );

        $this->getInfo();
        $resumen = $this->resumenMoviles;

        $callback = function() use($resumen, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,"\t");

            foreach ($resumen as $m) {
                $linea = array(
                    $m->nombre
                    , $m->cantidad_oot_ruta, $m->cantidad_oot_control1, $m->cantidad_oot_control2, $m->cantidad_oot_emvases, $m->cantidad_oot_fin_envases, $m->cantidad_oot_descarga, $m->cantidad_oot_espera
                    , $m->cantidad_ruta, $m->cantidad_control1, $m->cantidad_control2, $m->cantidad_envases, $m->cantidad_fin_envases, $m->cantidad_descarga, $m->cantidad_espera
                    , $this->getPorcentaje($m->cantidad_oot_ruta, $m->cantidad_ruta)
                    , $this->getPorcentaje($m->cantidad_oot_control1, $m->cantidad_control1)
                    , $this->getPorcentaje($m->cantidad_oot_control2, $m->cantidad_control2)
                    , $this->getPorcentaje($m->cantidad_oot_envases, $m->cantidad_envases)
                    , $this->getPorcentaje($m->cantidad_oot_fin_envases, $m->cantidad_fin_envases)
                    , $this->getPorcentaje($m->cantidad_oot_descarga, $m->cantidad_descarga)
                    , $this->getPorcentaje($m->cantidad_oot_espera, $m->cantidad_espera)
                    , $m->oot, $m->cantidad
                    , $this->getPorcentaje($m->oot, $m->cantidad)
                );
                fputcsv($file, $linea,"\t");
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getInfo(){

        $ini = $this->desde;
        $fin = $this->hasta;

        $this->resumenMoviles = Recorridos::
            select(
                // General
                'moviles.nombre'
                , DB::raw('count(recorridos.moviles_id) as cantidad')
                , DB::raw("sum(case estado when 'OutOfTime' then 1 else 0 end) as oot")
                // captados
                , DB::raw("sum(case when puntos_id = 1 then 1 else 0 end) as cantidad_ruta")
                , DB::raw("sum(case when puntos_id = 2 then 1 else 0 end) as cantidad_control1")
                , DB::raw("sum(case when puntos_id = 3 then 1 else 0 end) as cantidad_control2")
                , DB::raw("sum(case when puntos_id = 4 then 1 else 0 end) as cantidad_envases")
                , DB::raw("sum(case when puntos_id = 5 then 1 else 0 end) as cantidad_fin_envases")
                , DB::raw("sum(case when puntos_id = 6 then 1 else 0 end) as cantidad_descarga")
                , DB::raw("sum(case when puntos_id = 7 then 1 else 0 end) as cantidad_espera")
                // oot
                , DB::raw("sum(case when puntos_id = 1 and estado = 'OutOfTime' then 1 else 0 end) as cantidad_oot_ruta")
                , DB::raw("sum(case when puntos_id = 2 and estado = 'OutOfTime' then 1 else 0 end) as cantidad_oot_control1")
                , DB::raw("sum(case when puntos_id = 3 and estado = 'OutOfTime' then 1 else 0 end) as cantidad_oot_control2")
                , DB::raw("sum(case when puntos_id = 4 and estado = 'OutOfTime' then 1 else 0 end) as cantidad_oot_envases")
                , DB::raw("sum(case when puntos_id = 5 and estado = 'OutOfTime' then 1 else 0 end) as cantidad_oot_fin_envases")
                , DB::raw("sum(case when puntos_id = 6 and estado = 'OutOfTime' then 1 else 0 end) as cantidad_oot_descarga")
                , DB::raw("sum(case when puntos_id = 7 and estado = 'OutOfTime' then 1 else 0 end) as cantidad_oot_espera")
                )
            ->join('moviles', 'recorridos.moviles_id', '=', 'moviles.id')
            ->whereIn('recorridos.tiers_id', $this->tiers)
            ->whereDate('inicio', '>=', $ini)
            ->whereDate('inicio', '<=', $fin)
            ->groupBy('moviles.nombre')
            //->orderByRaw('2 desc')
            ->get()
        ;
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-tiempos-desvios-moviles');
    }
}
