<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Traits\ExportarExcel;
use App\Traits\JornadaTotalTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaJornada extends Component
{
    use JornadaTotalTime;
    use ExportarExcel;

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
        $columns = array('Tiers', 'Fecha', 'Chofer', 'Movil', 'TML', 'Hora Ruta', 'TR', 'T. Interno', 'Liquidación', 'Caja', 'T. Financiero', 'T. Warehouse', 'T. de desplazamiento', 'Jornada');

        $datos = Array();
        foreach($this->jornada as $jornada):
            $datos[] = Array(
                $jornada['tiers_nombre'],
                $jornada['fecha'],
                $jornada['chofer_nombre'],
                $jornada['movil_nombre'],
                $jornada['tml'],
                $jornada['ruta'],
                $jornada['tr'],
                $jornada['tmi'],
                $jornada['liquidacion'],
                $jornada['caja'],
                $jornada['tfinanciero'],
                $jornada['warehouse'],
                $jornada['desplazamiento'],
                $this->getTotalTime([$jornada['tml'], $jornada['tr'], $jornada['tmi']]),
            );
        endforeach;
        
        return $this->getFile('JornadaT2.xls', $columns, $datos);
    }

    public function getInfo(){

        $tml = 'and (
            exists(select r.inicio from recorridos r where cast(r.inicio as date) = cast("recorridos".inicio as date) and r.moviles_id = moviles.id and r.puntos_id='.env('RUTA').' and r.viaje = "recorridos".viaje limit 1)
            and
            (select r.inicio from recorridos r where cast(r.inicio as date) = cast("recorridos".inicio as date) and r.moviles_id = moviles.id and r.puntos_id='.env('RUTA').' and r.viaje = "recorridos".viaje limit 1) >= inicio
        )';

        $tmi = 'and (
            exists(select r.fin from recorridos r where cast(r.inicio as date) = cast("recorridos".inicio as date) and r.moviles_id = moviles.id and r.puntos_id='.env('RUTA').' and r.viaje = "recorridos".viaje limit 1)
            and
            (select r.fin from recorridos r where cast(r.inicio as date) = cast("recorridos".inicio as date) and r.moviles_id = moviles.id and r.puntos_id='.env('RUTA').' and r.viaje = "recorridos".viaje limit 1) <= inicio
        )';

        $this->jornada = DB::table('recorridos')->select([
            'recorridos.tiers_id'
            , 'tiers.nombre as tiers_nombre'
            , 'recorridos.choferes_id'
            , 'choferes.nombre as chofer_nombre'
            , DB::raw("cast(recorridos.inicio as date) as fecha")
            , DB::raw("string_agg(distinct moviles.nombre::text, ',') as movil_nombre")
            , DB::raw("sum( case when puntos.tipo_tiempo = 'tml' {$tml} then fin-inicio else '00:00:00' end ) tml")
            , DB::raw("sum( case when puntos.tipo_tiempo = 'tmr' then fin-inicio else '00:00:00' end ) tr")
            , DB::raw("sum( case when puntos.tiempos_fisicos = True {$tmi} then fin-inicio else '00:00:00' end ) tfisico")
            , DB::raw("sum( case when puntos.tiempos_financieros = True {$tmi} then fin-inicio else '00:00:00' end ) tfinanciero")
            , DB::raw("sum( case when puntos.tipo_tiempo = 'tmi' {$tmi} then fin-inicio else '00:00:00' end ) tmi")
            , DB::raw("sum( case when puntos.id in (".env('LIQUIDACION').") {$tmi} then fin-inicio else '00:00:00' end ) liquidacion")
            , DB::raw("sum( case when puntos.id in (".env('CAJA').") {$tmi} then fin-inicio else '00:00:00' end ) caja")
            , DB::raw("sum( case when puntos.id in (".env('WAREHOUSE').") {$tmi} then fin-inicio else '00:00:00' end ) warehouse")
            , DB::raw("sum( case when puntos.id in (".env('DESPLAZAMIENTO').") {$tmi} then fin-inicio else '00:00:00' end ) desplazamiento")
            , DB::raw("min( case when puntos.id in (".env('RUTA').") then cast(inicio as time) end ) ruta")
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
            ->groupBy(['recorridos.tiers_id', 'tiers.nombre', 'recorridos.choferes_id', 'choferes.nombre'])
            ->get();
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-jornada');
    }
}
