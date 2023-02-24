<?php

namespace App\Http\Livewire\Operadoras;

use App\Models\Operadoras;
use Livewire\Component;

class OperadorasForm extends Component
{
    public Operadoras $operador;

    protected function rules(){
        return [
            'operador.nombre' => 'required|min:5',
            'operador.activo' => ''
        ];
    }

    public function updated($property){
        $this->validateOnly($property);
    }

    public function mount($id){
        if($id == 0){
            $this->operador = new Operadoras();
            $this->operador->activo = true;
        }else{
            $this->operador = Operadoras::find($id);
        }
    }

    public function save(){
        $this->validate();

        $this->operador->save();

        session()->flash('message', 'Operador Logístico guardado!');
        return redirect()->to('/operadora');
    }

    public function render()
    {
        return view('livewire.operadoras.operadoras-form');
    }
}
