<?php

namespace App\Http\Livewire\Dashboards;

use Livewire\Component;

class Jornada extends Component
{
    public $desde;
    public $hasta;
    public $tiers = ['1' => true, '2' => true];

    public function mount(){
        $this->desde = date('Y-m-d');
        $this->hasta = date('Y-m-d');
        $this->emitir();
    }

    public function emitir(){
        $this->emit('actualizarJornada', ['desde' => $this->desde, 'hasta' => $this->hasta, 'tiers' => $this->tiers]);
    }

    public function render()
    {
        return view('livewire.dashboards.jornada');
    }
}
