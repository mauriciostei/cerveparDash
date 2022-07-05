<?php

namespace App\Http\Livewire\Puntos;

use App\Models\Puntos;
use Livewire\Component;

class PuntosList extends Component
{
    public $puntos;

    public function render()
    {
        $this->puntos = Puntos::all();
        return view('livewire.puntos.puntos-list');
    }
}
