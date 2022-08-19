<?php

namespace App\Http\Livewire\Dashboards;

use App\Models\Recorridos;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Metricas extends Component
{
    public $desde;
    public $hasta;
    public $tiers = ['1' => true, '2' => true];

    public $ingresoHora;
    public $topDesvios;
    public $cantidadAnomalias;

    public $tm;
    public $GlobalTM;

    public $resumenMoviles;
    public $resumenPuntos;

    public function mount(){
        $this->desde = date('Y-m-d');
        $this->hasta = date('Y-m-d');
    }


    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.metricas');
    }

    public function getPorcentaje($oot, $cantidad){
        $valor = 0;
        if($cantidad > 0 && $oot > 0){
            $valor = ($oot / $cantidad) * 100;
        }
        $valor = round($valor , 0);

        return $valor;
    }

    public function getHTML($oot, $cantidad){
        $valor = $this->getPorcentaje($oot, $cantidad);

        $color = '';

        if($valor > 50)
            $color = 'bg-red';
        if($valor <= 50 && $valor > 25)
            $color = 'bg-warning';
        if($valor <= 25 && $valor > 10)
            $color = 'bg-yellow';
        if($valor <= 10)
            $color = 'bg-success';

        $res = "<td><div class='".$color."'><div class='text-center text-dark'>".$valor."% </div></div></td>";

        echo $res;
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
            ,'En Ruta', 'Control 1', 'Control 2', 'Envases', 'Fin Envases', 'Descarga', 'Espera'
            ,'En Ruta', 'Control 1', 'Control 2', 'Envases', 'Fin Envases', 'Descarga', 'Espera'
            ,'En Ruta', 'Control 1', 'Control 2', 'Envases', 'Fin Envases', 'Descarga', 'Espera'
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
        $tiers = '0';
        $tiers = $this->tiers[1] ? $tiers.',1' : $tiers;
        $tiers = $this->tiers[2] ? $tiers.',2' : $tiers;

        $ingresoHora = collect(DB::select("select * from ingreso_x_hora(?, ?) where id in (".$tiers.")", [$ini, $fin]));
        $topDesvios = collect(DB::select("select * from top_desvios(?, ?, 5) where tier_id in (".$tiers.")", [$ini, $fin]));
        $cantidadAnomalias = collect(DB::select("select * from cantidad_anomalias(?, ?) where id in (".$tiers.")", [$ini, $fin]));
        $this->tm = collect(DB::select("select * from tiempo_medios(?, ?) where id in (".$tiers.")", [$ini, $fin]));
        $this->GlobalTM = collect(DB::select("select avg(tmi) tmi, avg(tmr) tmr from tiempo_medios(?, ?) where id in (".$tiers.")", [$ini, $fin]));


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
            ->whereIn('recorridos.tiers_id', array_keys($this->tiers, true))
            ->whereDate('inicio', '>=', $ini)
            ->whereDate('inicio', '<=', $fin)
            ->groupBy('moviles.nombre')
            //->orderByRaw('2 desc')
            ->get()
        ;

        $this->resumenPuntos = Recorridos::
            select(
                'puntos.nombre'
                , DB::raw("sum(case when tiers_id = 1 then 1 else 0 end) as cantidad_t1")
                , DB::raw("sum(case when tiers_id = 1 and estado = 'OutOfTime' then 1 else 0 end) oot_t1")
                , DB::raw("sum(case when tiers_id = 2 then 1 else 0 end) as cantidad_t2")
                , DB::raw("sum(case when tiers_id = 2 and estado = 'OutOfTime' then 1 else 0 end) oot_t2")
                )
            ->join('puntos', 'recorridos.puntos_id', '=', 'puntos.id')
            ->whereIn('recorridos.tiers_id', array_keys($this->tiers, true))
            ->whereDate('inicio', '>=', $ini)
            ->whereDate('inicio', '<=', $fin)
            ->groupBy('puntos.nombre')
            ->get()
        ;

        $labels = [];
        $t1 = [];
        $t2 = [];
        foreach($ingresoHora as $ih){
            $ini = explode(':', $ih->ini);
            $fin = explode(':', $ih->fin);
            $hora = $ini[0].' a '.$fin[0];
            if(!in_array($hora, $labels)){
                array_push($labels, $ini[0].' a '.$fin[0]);
            }
            if($ih->id == 1){
                array_push($t1, $ih->moviles);
            }else{
                array_push($t2, $ih->moviles);
            }
        }
        $this->ingresoHora = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tier 1', 'data' => $t1, 'backgroundColor' => '#37CBFF'),
            Array('label' => 'Tier 2', 'data' => $t2, 'backgroundColor' => '#F6AB16')
        ]);

        $labels = [];
        $t1 = [];
        $t2 = [];
        foreach($topDesvios as $td){
            if(!in_array($td->movil_nombre, $labels)){
                array_push($labels, $td->movil_nombre);
            }
            if($td->tier_id == 1){
                array_push($t1, $td->hora);
            }else{
                array_push($t2, $td->hora);
            }
        }
        $this->topDesvios = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tier 1', 'data' => $t1, 'backgroundColor' => '#37CBFF'),
            Array('label' => 'Tier 2', 'data' => $t2, 'backgroundColor' => '#F6AB16')
        ]);

        $labels = [];
        $t1 = [];
        $t2 = [];
        foreach($cantidadAnomalias as $ca){
            $ini = explode(':', $ca->ini);
            $fin = explode(':', $ca->fin);
            $hora = $ini[0].' a '.$fin[0];
            if(!in_array($hora, $labels)){
                array_push($labels, $ini[0].' a '.$fin[0]);
            }
            if($ca->id == 1){
                array_push($t1, $ca->cantidad);
            }else{
                array_push($t2, $ca->cantidad);
            }
        }
        $this->cantidadAnomalias = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tier 1', 'data' => $t1, 'backgroundColor' => '#37CBFF'),
            Array('label' => 'Tier 2', 'data' => $t2, 'backgroundColor' => '#F6AB16')
        ]);

        $this->emit('updateGraph', $this->ingresoHora, $this->topDesvios, $this->cantidadAnomalias);
    }
}
