<?php

namespace App\Http\Livewire\Choferes;

use App\Models\Choferes;
use Livewire\Component;

class ChoferesList extends Component
{
    public $choferes;

    public function render()
    {
        $this->choferes = Choferes::all();
        return view('livewire.choferes.choferes-list');
    }
}
