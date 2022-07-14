<?php

namespace App\Http\Livewire\Dashboards;

use App\Models\Moviles;
use App\Models\Puntos;
use App\Models\Recorridos;
use App\Models\Tiers;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ControlMoviles extends Component
{
    public $recorridos;
    public $tiers_id = 2;
    public $viaje = 1;

    public $tiers;
    public $puntos;

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.control-moviles');
    }

    public function getPunto($p){
        $punto =  Puntos::find($p);
        return $punto->nombre;
    }

    public function getInfo(){
        $this->tiers = Tiers::all();

        $this->puntos = DB::table('puntos_tiers')->where('tiers_id', $this->tiers_id)->where('viaje', $this->viaje)->orderBy('orden', 'asc')->get();

        $this->recorridos = Recorridos::
        whereDate('created_at', date('Y-m-d'))
            ->where('fin', null)
            ->where('tiers_id', $this->tiers_id)
            ->where('viaje', $this->viaje)
        ->get();
    }
}
