<?php

namespace App\Http\Livewire\Sensores;

use App\Models\Sensores;
use Livewire\Component;

class SensoresList extends Component
{
    public $sensores;

    public function render()
    {
        $this->sensores = Sensores::all();
        return view('livewire.sensores.sensores-list');
    }
}
