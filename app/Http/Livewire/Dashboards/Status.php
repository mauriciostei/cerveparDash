<?php

namespace App\Http\Livewire\Dashboards;

use App\Models\Recorridos;
use App\Models\Tiers;
use Livewire\Component;

class Status extends Component
{
    public $tiers;
    public $recorridos;

    public function getInfo(){
        $this->tiers = Tiers::where('activo', true)->get();

        $this->recorridos = Recorridos::
        whereDate('inicio', date('Y-m-d'))
            ->where('fin', null)
        ->get();
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.status');
    }
}
