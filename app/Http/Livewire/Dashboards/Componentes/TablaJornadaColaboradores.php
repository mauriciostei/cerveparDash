<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Traits\DifTime;
use App\Traits\ExportarExcel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaJornadaColaboradores extends Component
{
    use ExportarExcel;
    use DifTime;

    public $desde;
    public $hasta;

    public $jornada;

    protected $listeners = ['actualizarJornada'];

    public function actualizarJornada($datos){
        $this->desde = $datos['desde'];
        $this->hasta = $datos['hasta'];
    }

    public function exportar(){
        $columns = array('Colaborador', 'Fecha', 'Entrada', 'Salida', 'Jornada Total');

        $datos = Array();
        foreach($this->jornada as $jornada):
            $datos[] = Array(
                $jornada['colaborador'],
                $jornada['fecha'],
                $jornada['entrada'],
                $jornada['salida'],
                $this->difTimeFromOnlyTime($jornada['entrada'], $jornada['salida']),
            );
        endforeach;
        
        return $this->getFile('JornadaColaboradores.xls', $columns, $datos);
    }

    public function getInfo(){
        $this->jornada = DB::table('jornada_warehouses')->select([
            DB::raw("cast(jornada_warehouses.fecha_hora as date) as fecha")
            , 'colaboradores.nombre as colaborador'
            , 'colaboradores.cedula as cedula'
            , DB::raw("min( case when puntos.id in (".env('PUNTO_ENTRADA').") then cast(jornada_warehouses.fecha_hora as time) end ) entrada")
            , DB::raw("min( case when puntos.id in (".env('PUNTO_SALIDA').") then cast(jornada_warehouses.fecha_hora as time) end ) salida")
        ])
            ->join('puntos', 'jornada_warehouses.puntos_id', '=', 'puntos.id')
            ->join('colaboradores', 'jornada_warehouses.colaboradores_id', '=', 'colaboradores.id')
            ->whereRaw("cast(jornada_warehouses.fecha_hora as date) between '$this->desde' and '$this->hasta'")
            ->groupByRaw("cast(jornada_warehouses.fecha_hora as date), colaboradores.nombre, colaboradores.cedula")
            ->get();
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-jornada-colaboradores');
    }
}
