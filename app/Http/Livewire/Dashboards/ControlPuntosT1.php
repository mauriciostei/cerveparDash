<?php

namespace App\Http\Livewire\Dashboards;

use App\Models\Puntos;
use App\Models\Recorridos;
use App\Models\Tiers;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ControlPuntosT1 extends Component
{
    public $tiers_id = 1;
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

    public function getRecorrido($moviles_id, $punto){
        $r = Recorridos::
            where('moviles_id', $moviles_id)
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

        $this->recorridos = Recorridos::select([DB::raw("string_agg(distinct choferes.nombre::text, ',') as choferes_nombre"), 'moviles.nombre as moviles_nombre','recorridos.moviles_id as moviles_id'])
        ->join('choferes', 'recorridos.choferes_id', '=', 'choferes.id')
            ->join('moviles', 'recorridos.moviles_id', '=', 'moviles.id')
            ->whereDate('inicio', $this->fecha)
            ->where('viaje', $this->viaje)
            ->where('moviles.tiers_id', $this->tiers_id)
            ->where('choferes.tiers_id', $this->tiers_id)
            ->groupBy('recorridos.moviles_id','moviles.nombre', 'choferes.nombre')
            ->get();
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.control-puntos-t1');
    }
}