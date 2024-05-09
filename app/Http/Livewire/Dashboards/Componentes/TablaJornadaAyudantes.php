<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Traits\DifTime;
use App\Traits\ExportarExcel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaJornadaAyudantes extends Component
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
        $columns = array('Ayudante', 'Fecha', 'Entrada', 'Salida', 'Jornada Total');

        $datos = Array();
        foreach($this->jornada as $jornada):
            $datos[] = Array(
                $jornada['ayudante'],
                $jornada['fecha'],
                $jornada['entrada'],
                $jornada['salida'],
                $this->difTimeFromOnlyTime($jornada['entrada'], $jornada['salida']),
            );
        endforeach;
        
        return $this->getFile('JornadaAyudantes.xls', $columns, $datos);
    }

    public function getInfo(){
        $this->jornada = DB::table('jornada_ayudantes')->select([
            DB::raw("cast(jornada_ayudantes.fecha_hora as date) as fecha")
            , 'ayudantes.nombre as ayudante'
            , 'ayudantes.cedula as cedula'
            , DB::raw("min( case when puntos.id in (".env('PUNTO_ENTRADA').") then cast(jornada_ayudantes.fecha_hora as time) end ) entrada")
            , DB::raw("min( case when puntos.id in (".env('PUNTO_SALIDA').") then cast(jornada_ayudantes.fecha_hora as time) end ) salida")
        ])
            ->join('puntos', 'jornada_ayudantes.puntos_id', '=', 'puntos.id')
            ->join('ayudantes', 'jornada_ayudantes.ayudantes_id', '=', 'ayudantes.id')
            ->whereRaw("cast(jornada_ayudantes.fecha_hora as date) between '$this->desde' and '$this->hasta'")
            ->groupByRaw("cast(jornada_ayudantes.fecha_hora as date), ayudantes.nombre, ayudantes.cedula")
            ->get();
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-jornada-ayudantes');
    }
}
