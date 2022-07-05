<?php

namespace App\Http\Livewire\Tiers;

use App\Models\Tiers;
use Livewire\Component;

class TiersForm extends Component
{
    public Tiers $tier;
    public $puntos;

    public $arrPuntos;

    protected $rules = [
        'tier.nombre' => 'required|string|min:5',
        'tier.activo' => ''
    ];

    protected $messages = [
        'tier.nombre.required' => 'El campo nombre no puede ser nulo',
        'tier.nombre.min' => 'El nombre debe contener al menos 5 caracteres',
    ];

    public function mount($id){
        if($id == 0){
            $this->tier = new Tiers();
            $this->tier->activo = true;
            
        }else{
            $this->tier = Tiers::find($id);
        }
    }

    public function save(){
        $this->validate();

        $this->tier->save();

        session()->flash('message', 'Tiers guardado!');
        return redirect()->to('/tiers');
    }

    public function render()
    {
        return view('livewire.tiers.tiers-form');
    }
}
