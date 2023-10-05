<?php

namespace App\Http\Livewire\Alertas;

use App\Models\Alertas;
use App\Models\Causas;
use Livewire\Component;

class AlertasTma extends Component
{
    public Alertas $alerta;
    public $causas;

    public function rules(){
        return [
            'alerta.causas_id' => 'required|exists:causas,id',
            'alerta.observaciones' => 'required|max:200'
        ];
    }

    public function mount(Alertas $alerta){
        $this->alerta = $alerta;
        $this->causas = Causas::all();
    }

    public function save(){
        $this->validate();

        $this->alerta->visible = false;
        $this->alerta->inicio = now();
        $this->alerta->fin = now();
        $this->alerta->save();

        session()->flash('message', 'Alerta gestionada!');
        return redirect()->to('/inicio');
    }

    public function render()
    {
        return view('livewire.alertas.alertas-tma');
    }
}
