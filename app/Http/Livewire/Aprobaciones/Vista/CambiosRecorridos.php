<?php

namespace App\Http\Livewire\Aprobaciones\Vista;

use App\Models\CambiosRecorridos as ModelsCambiosRecorridos;
use Livewire\Component;

class CambiosRecorridos extends Component
{
    public $cambioRecorrido;

    public function mount($id){
        $this->cambioRecorrido = ModelsCambiosRecorridos::find($id);
    }

    public function render()
    {
        return view('livewire.aprobaciones.vista.cambios-recorridos');
    }
}
