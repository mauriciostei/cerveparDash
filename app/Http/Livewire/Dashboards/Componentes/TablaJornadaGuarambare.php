<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Traits\CalculateColorT1;
use App\Traits\CorrespondeViaje;
use App\Traits\ExportarExcel;
use App\Traits\TurnoJornadaT1;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaJornadaGuarambare extends Component
{
    use CalculateColorT1;
    use TurnoJornadaT1;
    use ExportarExcel;
    use CorrespondeViaje;

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
        $columns = array('Tiers', 'Fecha', 'Chofer', 'Movil', 'Corresponde', 'Hora', 'T. Espera', 'T. Atendimiento', 'Permanencia');

        $datos = Array();
        foreach($this->jornada as $jornada):
            $datos[] = Array(
                $jornada['tiers_nombre']
                , $jornada['fecha']
                , $jornada['chofer_nombre']
                , $jornada['movil_nombre']
                , $this->corresponde($jornada['fecha'], $jornada['moviles_id'], $jornada['choferes_id'], $jornada['viaje'])
                , $this->getInicio($jornada['moviles_id'], $jornada['choferes_id'], $jornada['viaje'], $jornada['fecha'])
                , $jornada['espera']
                , $jornada['control']
                , $jornada['atendimiento']
                , $jornada['ttotal']
            );
        endforeach;
        
        return $this->getFile('JornadaT1.xls', $columns, $datos);
    }

    public function getInfo(){
        $this->jornada = DB::table('recorridos')->select([
            'recorridos.tiers_id'
            , 'tiers.nombre as tiers_nombre'
            , 'recorridos.viaje'
            , 'recorridos.choferes_id'
            , 'choferes.nombre as chofer_nombre'
            , 'recorridos.moviles_id'
            , 'moviles.nombre as movil_nombre'
            , DB::raw("cast(recorridos.inicio as date) as fecha")
            , DB::raw("sum( case when puntos.id in (".env('ESPERA').") then fin-inicio else '00:00:00' end ) espera")
            , DB::raw("sum( case when puntos.id in (".env('CONTROL1').") then fin-inicio else '00:00:00' end ) control")
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
            ->groupBy(['recorridos.tiers_id', 'tiers.nombre', 'recorridos.viaje', 'recorridos.choferes_id', 'recorridos.moviles_id', 'choferes.nombre', 'moviles.nombre'])
            ->get();
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-jornada-guarambare');
    }
}
