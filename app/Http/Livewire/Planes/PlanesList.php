<?php

namespace App\Http\Livewire\Planes;

use App\Models\Planes;
use Livewire\Component;

class PlanesList extends Component
{
    public $planes;

    public function render()
    {
        //$this->planes = Planes::all();
        $this->planes = Planes::select(['planes.*', 'acuraccy.porcentaje'])->join('acuraccy', 'acuraccy.id', 'planes.id')->get();
        return view('livewire.planes.planes-list');
    }
}
