<?php

namespace App\Http\Livewire\Soluciones;

use App\Models\Soluciones;
use Livewire\Component;

class SolucionesList extends Component
{
    public $soluciones;

    public function render()
    {
        $this->soluciones = Soluciones::all();
        return view('livewire.soluciones.soluciones-list');
    }
}
