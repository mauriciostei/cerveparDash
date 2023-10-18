<?php

namespace App\Http\Livewire\Causas;

use App\Models\CausaRaiz;
use Livewire\Component;

class CausasRaizForm extends Component
{
    public CausaRaiz $causa;

    public function rules(){
        return [
            'causa.nombre' => 'required|string',
            'causa.activo' => 'required|boolean',
        ];
    }

    public function mount($id){
        if($id == 0){
            $this->causa = new CausaRaiz();
            $this->causa->activo = true;
        }else{
            $this->causa = CausaRaiz::find($id);
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
        return view('livewire.causas.causas-raiz-form');
    }
}
