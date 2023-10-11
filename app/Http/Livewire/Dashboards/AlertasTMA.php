<?php

namespace App\Http\Livewire\Dashboards;

use Livewire\Component;

class AlertasTMA extends Component
{
    public $desde;
    public $hasta;
    public $tiers = ['1' => true, '2' => true];

    public function mount(){
        $this->desde = date('Y-m-d');
        $this->hasta = date('Y-m-d');
    }

    public function emitir(){
        $this->emit('actualizarTable', ['desde' => $this->desde, 'hasta' => $this->hasta, 'tiers' => $this->tiers]);
    }

    public function updated(){
        $this->emitir();
    }

    public function render()
    {
        return view('livewire.dashboards.alertas-t-m-a');
    }
}
