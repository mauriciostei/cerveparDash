<?php

namespace App\Http\Livewire\Tiers;

use App\Models\Puntos;
use App\Models\Tiers;
use App\Models\Viajes;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ViajeForm extends Component
{
    public Tiers $tier;
    public Viajes $viaje;

    public $tma;
    public $puntos;
    public $arrPuntos = [];

    protected function rules(){
        return [
            'tier.id' => 'required|exists:tiers,id',
            'viaje.id' => 'required|exists:viajes,id',
            'tma' => 'required',
            'arrPuntos' => 'required',
            'arrPuntos.*.puntos_id' => 'required|exists:puntos,id',
        ];
    }

    public function mount(Tiers $tier){
        $this->tier = $tier;
        $this->puntos = Puntos::all();
    }

    public function changeViaje($value){
        $this->viaje = Viajes::find($value);

        $tiers_viajes = DB::table('tiers_viajes')->where('tiers_id', $this->tier->id)->where('viajes_id', $this->viaje->id)->first();
        $this->tma = $tiers_viajes ? $tiers_viajes->tiempo_tma : '00:00:00';

        $this->arrPuntos = [];
        foreach($this->tier->puntos as $tp){
            if($tp->pivot->viaje == $this->viaje->id){
                $this->arrPuntos[] = ["puntos_id" => $tp->id,  "target" => $tp->pivot->target, "ponderacion" => $tp->pivot->ponderacion];
            }
        }
    }

    public function agregarPunto(){
        $this->arrPuntos[] = ["puntos_id" => 0,  "target" => "00:02:00", "ponderacion" => "00:02:00"];
    }

    public function eliminarPunto($index){
        unset($this->arrPuntos[$index]);
        $this->arrPuntos = array_values($this->arrPuntos);
    }

    public function mover($posicion, $direccion){
        $posNueva = ($direccion == 'arriba') ? $posicion - 1 : $posicion + 1;
        
        $movido = $this->arrPuntos[$posicion];
        $actual = $this->arrPuntos[$posNueva];

        $this->arrPuntos[$posicion] = $actual;
        $this->arrPuntos[$posNueva] = $movido;

        $this->arrPuntos = array_values($this->arrPuntos);
    }

    public function save(){
        $this->validate();

        DB::table('tiers_viajes')->upsert(['tiers_id' => $this->tier->id, 'viajes_id' => $this->viaje->id, 'tiempo_tma' => $this->tma], ['tiers_id', 'viajes_id']);

        DB::table('puntos_tiers')->where('tiers_id', $this->tier->id)->where('viaje', $this->viaje->id)->delete();

        foreach($this->arrPuntos as $index => $arr):
            DB::table('puntos_tiers')->insert([
                'puntos_id' => $arr['puntos_id']
                , 'tiers_id' => $this->tier->id
                , 'viaje' => $this->viaje->id
                , 'orden' => $index + 1
                , 'target' => $arr['target']
                , 'ponderacion' => $arr['ponderacion']
                , 'created_at' => now()
                , 'updated_at' => now()
            ]);
        endforeach;

        session()->flash('message', 'Viaje guardado!');
        return redirect()->to('/tiers');
    }

    public function render()
    {
        return view('livewire.tiers.viaje-form');
    }
}
