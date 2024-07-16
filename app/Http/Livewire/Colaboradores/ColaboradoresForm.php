<?php

namespace App\Http\Livewire\Colaboradores;

use App\Models\Colaboradores;
use Livewire\Component;

class ColaboradoresForm extends Component
{
    public Colaboradores $colaborador;

    protected function rules(){
        return [
            'colaborador.nombre' => 'required|min:5',
            'colaborador.cedula' => 'required|min:3|unique:colaboradores,cedula'.($this->colaborador->id > 0 ? ",".$this->colaborador->id : ""),
        ];
    }

    protected $messages = [
        'colaborador.nombre.required' => 'El campo nombre no puede ser nulo',
        'colaborador.nombre.min' => 'El nombre debe contener al menos 5 caracteres',
        'colaborador.cedula.required' => 'El numero de documento es requerido',
        'colaborador.cedula.min' => 'El numero de documento debe contener al menos 3 caracteres',
        'colaborador.cedula.unique' => 'Este numero de documento ya se encuentra registrado',
    ];

    public function updated($property){
        $this->validateOnly($property);
    }

    public function mount($id){
        if($id == 0){
            $this->colaborador = new Colaboradores();
        }else{
            $this->colaborador = Colaboradores::find($id);
        }
    }

    public function save(){
        $this->validate();

        $this->colaborador->save();

        session()->flash('message', 'Colaborador guardado!');
        return redirect()->to('/colaboradores');
    }

    public function render()
    {
        return view('livewire.colaboradores.colaboradores-form');
    }
}
