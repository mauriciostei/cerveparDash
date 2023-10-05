<?php

namespace App\Http\Livewire\Config;

use App\Models\Alertas;
use App\Models\Aprobaciones;
use Livewire\Component;

class AlertasBadge extends Component
{
    public $alertas;

    public function render(){
        $alertas = Alertas::countPending();
        $aprobaciones = Aprobaciones::countPending();
        $this->alertas = $alertas + $aprobaciones;
        return view('livewire.config.alertas-badge');
    }
}
