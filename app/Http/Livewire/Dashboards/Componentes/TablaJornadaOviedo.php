<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Traits\ExportarExcel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaJornadaOviedo extends Component
{
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
        $columns = array('Tiers', 'Fecha', 'Chofer', 'Movil', 'TML', 'TR', 'T. Interno', 'T. Financiero', 'T. Warehouse', 'Jornada');

        $columnsTaken = Array('tiers_nombre', 'fecha', 'chofer_nombre', 'movil_nombre', 'tml', 'tr', 'tmi', 'tfinanciero', 'warehouse', 'ttotal');

        return $this->getFile('JornadaT2.xls', $columns, $this->jornada, $columnsTaken);
    }

    public function getInfo(){
        $this->jornada = DB::table('recorridos')->select([
            'recorridos.tiers_id'
            , 'tiers.nombre as tiers_nombre'
            , 'recorridos.choferes_id'
            , 'choferes.nombre as chofer_nombre'
            , DB::raw("cast(recorridos.inicio as date) as fecha")
            , DB::raw("string_agg(distinct moviles.nombre::text, ',') as movil_nombre")
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
            ->groupByRaw("cast(recorridos.inicio as date)")
            ->groupBy(['recorridos.tiers_id', 'tiers.nombre', 'recorridos.choferes_id', 'choferes.nombre'])
            ->get();
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-jornada-oviedo');
    }
}
