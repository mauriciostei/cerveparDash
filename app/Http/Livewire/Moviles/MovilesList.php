<?php

namespace App\Http\Livewire\Moviles;

use App\Models\Moviles;
use Livewire\Component;

class MovilesList extends Component
{
    public $moviles;

    public function render()
    {
        $this->moviles = Moviles::all();
        return view('livewire.moviles.moviles-list');
    }
}
