<?php

namespace App\Http\Livewire\Config;

use App\Models\Alertas;
use Livewire\Component;

class AlertasBadge extends Component
{
    public $alertas;

    public function render(){
        $this->alertas = Alertas::where('visible', true)->count();
        return view('livewire.config.alertas-badge');
    }
}
