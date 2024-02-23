<?php

namespace App\Http\Livewire\Dashboards;

use App\Models\Puntos;
use App\Models\Recorridos;
use App\Models\Tiers;
use App\Traits\ExportarExcel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ControlPuntos extends Component
{
    use ExportarExcel;

    public $tiers_id = 2;
    public $viaje = 1;
    public $fecha;

    public $tiers;
    public $puntos;

    public $plan;
    public $recorridos;

    public function mount(){
        $this->fecha = date('Y-m-d');
    }

    public function getPunto($p){
        $punto =  Puntos::find($p);
        return $punto->nombre;
    }

    public function getRecorrido($chofer, $punto){
        $r = Recorridos::
            where('choferes_id', $chofer)
            ->where('puntos_id', $punto)
            ->whereDate('inicio', $this->fecha)
            ->where('viaje', $this->viaje)
            ->first()
        ;
        return $r->HoraInicio ?? null;
    }

    public function exportar(){
        $this->getInfo();
        $columns = array('Fecha','Movil','Cedula' ,'Chofer');
        foreach($this->puntos as $punto):
            $columns[] = $this->getPunto($punto->puntos_id);
        endforeach;

        $datos = Array();
        foreach($this->recorridos as $recorrido):
            $line = Array(
                $this->fecha,
                $recorrido['moviles_nombre'],
                $recorrido['documento'],
                strtoupper($recorrido['choferes_nombre']),
            );

            foreach($this->puntos as $punto):
                $line[] = $this->getRecorrido($recorrido['choferes_id'], $punto->puntos_id) ?? 'X';
            endforeach;

            $datos[] = $line;
        endforeach;

        return $this->getFile('ControlPuntosT2.xls', $columns, $datos);
    }

    public function getInfo(){
        $this->tiers = Tiers::all();

        $this->puntos = DB::table('puntos_tiers')->where('tiers_id', $this->tiers_id)->where('viaje', $this->viaje)->orderBy('orden', 'asc')->get();

        $this->recorridos = Recorridos::select(['recorridos.choferes_id', 'choferes.nombre as choferes_nombre', 'choferes.documento', DB::raw("string_agg(distinct moviles.nombre::text, ',') as moviles_nombre")])
            ->join('choferes', 'recorridos.choferes_id', '=', 'choferes.id')
            ->join('moviles', 'recorridos.moviles_id', '=', 'moviles.id')
            ->whereDate('inicio', $this->fecha)
            ->where('viaje', $this->viaje)
            ->where('moviles.tiers_id', $this->tiers_id)
            ->where('choferes.tiers_id', $this->tiers_id)
            ->groupBy('recorridos.choferes_id', 'choferes.nombre', 'choferes.documento')
            ->get();
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.control-puntos');
    }
}
