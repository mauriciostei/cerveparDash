<?php

namespace App\Http\Livewire\Moviles;

use App\Models\Choferes;
use App\Models\Moviles;
use App\Models\Tiers;
use Livewire\Component;

class MovilesForm extends Component
{
    public Moviles $movil;
    public $tiers;

    public $choferes;

    protected $rules = [
        'movil.nombre' => 'required|string|min:3',
        'movil.chapa' => 'required|string',
        'movil.activo' => '',
        'movil.tiers_id' => '',
        'movil.choferes_id' => '',
    ];

    protected $messages = [
        'movil.nombre.required' => 'El campo nombre no puede ser nulo',
        'movil.nombre.min' => 'El nombre debe contener al menos 3 caracteres',
        'movil.chapa.required' => 'La chapa del movil es requerida'
    ];

    public function mount($id){
        if($id == 0){
            $this->movil = new Moviles();
            $this->movil->activo = true;
            $this->movil->tiers_id = 1;
        }else{
            $this->movil = Moviles::find($id);
        }
        $this->tiers = Tiers::all();
        $this->choferes = Choferes::all();
    }

    public function save(){
        $this->validate();

        $this->movil->save();

        session()->flash('message', 'Movil guardado!');
        return redirect()->to('/moviles');
    }

    public function render()
    {
        return view('livewire.moviles.moviles-form');
    }
}
