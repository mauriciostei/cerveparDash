<?php

namespace App\Http\Livewire\Tiers;

use App\Models\Tiers;
use App\Models\TiersHours;
use Livewire\Component;

class TiersForm extends Component
{
    public Tiers $tier;
    public $puntos;

    // public $arrPuntos;
    public $arrHours = [];

    public function addHour(){
        $this->arrHours[] = ['corte' => '00:00:00', 'color' => ''];
    }

    public function delHour($index){
        unset($this->arrHours[$index]);
        // $this->arrPuntos = array_values($this->arrPuntos);
    }

    protected $rules = [
        'tier.nombre' => 'required|string|min:5',
        'tier.activo' => '',
        'arrHours.*.corte' => '',
        'arrHours.*.color' => '',
    ];

    protected $messages = [
        'tier.nombre.required' => 'El campo nombre no puede ser nulo',
        'tier.nombre.min' => 'El nombre debe contener al menos 5 caracteres',
    ];

    public function mount($id){
        if($id == 0){
            $this->tier = new Tiers();
            $this->tier->activo = true;
            $this->addHour();
            
        }else{
            $this->tier = Tiers::find($id);
            foreach($this->tier->hours as $hour):
                $this->arrHours[] = ['corte' => $hour->corte, 'color' => $hour->color];
            endforeach;
        }
    }

    public function save(){
        $this->validate();

        $this->tier->save();
        $this->tier->hours()->delete();

        foreach($this->arrHours as $hour):
            $hora = new TiersHours();
            $hora->tiers_id = $this->tier->id;
            $hora->color = $hour['color'];
            $hora->corte = $hour['corte'];
            $hora->save();
        endforeach;

        session()->flash('message', 'Tiers guardado!');
        return redirect()->to('/tiers');
    }

    public function render()
    {
        return view('livewire.tiers.tiers-form');
    }
}
