<?php

namespace App\Http\Livewire\Choferes;

use App\Models\Choferes;
use Livewire\Component;

class ChoferesForm extends Component
{
    public Choferes $chofer;

    protected $rules = [
        'chofer.nombre' => 'required|string|min:5',
        'chofer.documento' => 'required',
        'chofer.activo' => '',
    ];

    protected $messages = [
        'chofer.nombre.required' => 'El campo nombre no puede ser nulo',
        'chofer.nombre.min' => 'El nombre debe contener al menos 5 caracteres',
        'chofer.documento.required' => 'El numero de documento es requerido',
    ];

    public function mount($id){
        if($id == 0){
            $this->chofer = new Choferes();
            $this->chofer->activo = true;
        }else{
            $this->chofer = Choferes::find($id);
        }
    }

    public function save(){
        $this->validate();

        $this->chofer->save();

        session()->flash('message', 'Chofer guardado!');
        return redirect()->to('/choferes');
    }

    public function render()
    {
        return view('livewire.choferes.choferes-form');
    }
}
