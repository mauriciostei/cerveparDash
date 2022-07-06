<?php

namespace App\Http\Livewire\config;

use App\Models\Alertas;
use Livewire\Component;

class AlertasBox extends Component
{
    public $alertas;

    public function render()
    {
        $this->alertas = Alertas::where('visible', true)->orderBy('created_at', 'DESC')->get();
        $this->notificar();
        return view('livewire.config.alertas-box');
    }

    public function notificar(){
        foreach($this->alertas as $al){
            if(!$al->notificado){
                $this->emit('nuevaAlerta', $al);
                $al->notificado = true;
                $al->save();
            }
        }
    }
}
