<?php

namespace App\Http\Livewire\Ayudantes;

use App\Models\Ayudantes;
use Livewire\Component;

class AyudantesForm extends Component
{
    public Ayudantes $ayudante;

    protected function rules(){
        return [
            'ayudante.nombre' => 'required|min:5',
            'ayudante.cedula' => 'required|min:3|unique:ayudantes,cedula'.($this->ayudante->id > 0 ? ",".$this->ayudante->id : ""),
        ];
    }

    protected $messages = [
        'chofer.nombre.required' => 'El campo nombre no puede ser nulo',
        'chofer.nombre.min' => 'El nombre debe contener al menos 5 caracteres',
        'chofer.cedula.required' => 'El numero de documento es requerido',
        'chofer.cedula.min' => 'El numero de documento debe contener al menos 3 caracteres',
        'chofer.cedula.unique' => 'Este numero de documento ya se encuentra registrado',
    ];

    public function updated($property){
        $this->validateOnly($property);
    }

    public function mount($id){
        if($id == 0){
            $this->ayudante = new Ayudantes();
        }else{
            $this->ayudante = Ayudantes::find($id);
        }
    }

    public function save(){
        $this->validate();

        $this->ayudante->save();

        session()->flash('message', 'Ayudante guardado!');
        return redirect()->to('/ayudantes');
    }

    public function render()
    {
        return view('livewire.ayudantes.ayudantes-form');
    }
}
