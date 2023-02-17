<?php

namespace App\Http\Livewire\Dashboards;

use Livewire\Component;

class Jornada extends Component
{
    public $desde;
    public $hasta;
    public $tiers = ['2' => true];
    public $url;

    public function mount(){
        $this->desde = date('Y-m-d');
        $this->hasta = date('Y-m-d');
        $this->emitir();
        $this->url = $_SERVER['REQUEST_URI'];
    }

    public function emitir(){
        $this->emit('actualizarJornada', ['desde' => $this->desde, 'hasta' => $this->hasta, 'tiers' => $this->tiers]);
    }

    public function render()
    {
        return view('livewire.dashboards.jornada');
    }
}
