<?php

namespace App\Http\Livewire\Config;

use App\Models\Aprobaciones;
use Livewire\Component;

class AprobacionesBox extends Component
{
    public $aprobaciones;

    public function render()
    {
        $this->aprobaciones = Aprobaciones::totalPending();
        return view('livewire.config.aprobaciones-box');
    }
}
