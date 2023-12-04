<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Traits\CalculateColorT1;
use App\Traits\ExportarExcel;
use App\Traits\TurnoJornadaT1;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaJornadaT1 extends Component
{
    use CalculateColorT1;
    use TurnoJornadaT1;
    use ExportarExcel;

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
        $columns = array('Tiers', 'Fecha', 'Chofer', 'Movil', 'T. Espera', 'T. Atendimiento', 'Permanencia');

        $columnsTaken = Array('tiers_nombre', 'fecha', 'chofer_nombre', 'movil_nombre', 'espera', 'atendimiento', 'ttotal');

        return $this->getFile('JornadaT1.xls', $columns, $this->jornada, $columnsTaken);
    }

    public function corresponde($fecha, $movil, $chofer, $viaje){
        $query = DB::select(DB::raw("select corresponde
        from planes p
            join choferes_moviles_planes cmp on p.id = cmp.planes_id
        where p.fecha = '$fecha'
            and moviles_id = $movil
            and choferes_id = $chofer
            and viaje = $viaje"));
        return $query[0]->corresponde ? 'SI' : 'NO';
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
        return view('livewire.dashboards.componentes.tabla-jornada-t1');
    }
}
