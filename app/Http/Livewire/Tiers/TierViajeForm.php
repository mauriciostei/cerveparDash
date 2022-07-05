<?php

namespace App\Http\Livewire\Tiers;

use App\Models\Puntos;
use App\Models\Tiers;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TierViajeForm extends Component
{
    public Tiers $tier;
    public $puntos;
    public $viaje = 1;

    public $arrPuntos;

    public function render()
    {
        return view('livewire.tiers.tier-viaje-form');
    }

    public function agregarPunto(){
        $this->arrPuntos[] = ["orden" => 1, "puntos_id" => 0, "viaje" => $this->viaje, "target" => "00:02:00", "ponderacion" => "00:02:00"];
    }

    public function eliminarPunto($index){
        unset($this->arrPuntos[$index]);
        $this->arrPuntos = array_values($this->arrPuntos);
    }

    public function mount($id, $viaje){
        $this->tier = Tiers::find($id);
        $this->viaje = $viaje;

        foreach($this->tier->puntos as $tp){
            if($tp->pivot->viaje == $this->viaje){
                $this->arrPuntos[] = ["orden" => $tp->pivot->orden, "puntos_id" => $tp->id, "viaje" => $tp->pivot->viaje, "target" => $tp->pivot->target, "ponderacion" => $tp->pivot->ponderacion];
            }
        }

        if(!$this->arrPuntos){
            $this->arrPuntos = [ ["orden" => 1, "puntos_id" => 0, "viaje" => $this->viaje, "target" => "00:02:00", "ponderacion" => "00:02:00"] ];
        }
        
        $this->puntos = Puntos::all();
    }

    public function save(){
        //$this->validate();

        $finArr = [];
        foreach($this->arrPuntos as $arr){
            $finArr[] = [
                'puntos_id' => $arr['puntos_id']
                , 'tiers_id' => $this->tier->id
                , 'viaje' => $arr['viaje']
                , 'orden' => $arr['orden']
                , 'target' => $arr['target']
                , 'ponderacion' => $arr['ponderacion']
                , 'created_at' => now()
                , 'updated_at' => now()
            ];
        }

        DB::table('puntos_tiers')->upsert($finArr, [ 'tiers_id', 'viaje', 'orden']);

        session()->flash('message', 'Tiers guardado!');
        return redirect()->to('/tiers');
    }
}
