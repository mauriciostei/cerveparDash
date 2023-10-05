<?php

namespace App\Http\Livewire\Causas;

use App\Models\Causas;
use Livewire\Component;

class CausasForm extends Component
{
    public Causas $causa;

    public function rules(){
        return [
            'causa.nombre' => 'required|string',
            'causa.activo' => 'required|boolean',
        ];
    }

    public function mount($id){
        if($id == 0){
            $this->causa = new Causas();
            $this->causa->activo = true;
        }else{
            $this->causa = Causas::find($id);
        }
    }

    public function save(){
        $this->validate();

        $this->causa->save();

        session()->flash('message', 'Causa guardada!');
        return redirect()->to('/causas');
    }

    public function render()
    {
        return view('livewire.causas.causas-form');
    }
}
