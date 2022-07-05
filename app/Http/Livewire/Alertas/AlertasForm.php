<?php

namespace App\Http\Livewire\Alertas;

use App\Models\Alertas;
use Livewire\Component;

class AlertasForm extends Component
{
    public Alertas $alerta;

    public function mount($id){
        $this->alerta = Alertas::find($id);
    }

    public function render()
    {
        return view('livewire.alertas.alertas-form');
    }
}
