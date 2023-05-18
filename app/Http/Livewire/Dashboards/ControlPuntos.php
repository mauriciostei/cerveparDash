<?php

namespace App\Http\Livewire\Dashboards;

use App\Models\Puntos;
use App\Models\Recorridos;
use App\Models\Tiers;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ControlPuntos extends Component
{
    public $tiers_id = 2;
    public $viaje = 1;
    public $fecha;

    public $tiers;
    public $puntos;

    public $plan;

    public function mount(){
        $this->fecha = date('Y-m-d');
    }

    public function getPunto($p){
        $punto =  Puntos::find($p);
        return $punto->nombre;
    }

    public function getRecorrido($movil, $chofer, $punto){
        $r = Recorridos::
            where('moviles_id', $movil)
            ->where('choferes_id', $chofer)
            ->where('puntos_id', $punto)
            ->whereDate('inicio', $this->fecha)
            ->where('viaje', $this->viaje)
            ->first()
        ;
        return $r->HoraInicio ?? null;
    }

    public function getInfo(){
        $this->tiers = Tiers::all();

        $this->puntos = DB::table('puntos_tiers')->where('tiers_id', $this->tiers_id)->where('viaje', $this->viaje)->orderBy('orden', 'asc')->get();

        $this->plan = DB::table('choferes_moviles_planes')
            ->select(['moviles.nombre as moviles_nombre', 'choferes.nombre as choferes_nombre', 'moviles_id', 'choferes_id'])
            ->join('planes', 'id', '=', 'planes_id')
            ->join('moviles', 'choferes_moviles_planes.moviles_id', '=', 'moviles.id')
            ->join('choferes', 'choferes_moviles_planes.choferes_id', '=', 'choferes.id')
            ->where('planes.fecha', $this->fecha)
            ->where('viaje', $this->viaje)
            ->where('moviles.tiers_id', $this->tiers_id)
            ->where('choferes.tiers_id', $this->tiers_id)
            ->orderBy('moviles.nombre')
            ->get()
        ;
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.control-puntos');
    }
}
