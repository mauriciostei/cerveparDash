<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaTM extends Component
{
    public $desde;
    public $hasta;
    public $tiers;

    public $tm;
    public $GlobalTM;

    protected $listeners = ['actualizarTable'];

    public function mount(){
        $this->tiers = [1,2];
    }

    public function actualizarTable($datos){
        $this->desde = $datos['desde'];
        $this->hasta = $datos['hasta'];
        $this->tiers = [];
        foreach($datos['tiers'] as $index => $item):
            if($item){
                array_push($this->tiers, $index);
            }
        endforeach;
    }

    public function getInfo(){

        $ini = $this->desde;
        $fin = $this->hasta;
        $tiers = implode(',', $this->tiers) ? implode(',', $this->tiers) : '0';

        $this->tm = collect(DB::select("select *, tmi+tml+tmr jornada from tiempo_medios(?, ?) where id in (".$tiers.")", [$ini, $fin]));
        $this->GlobalTM = collect(DB::select("select avg(tmi) tmi, avg(tmr) tmr, avg(tml) tml, avg(tmi+tml+tmr) jornada from tiempo_medios(?, ?) where id in (".$tiers.")", [$ini, $fin]));
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-t-m');
    }
}
