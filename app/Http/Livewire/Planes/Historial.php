<?php

namespace App\Http\Livewire\Planes;

use App\Models\Planes;
use Livewire\Component;

class Historial extends Component
{
    public $plan;

    public function mount($id){
        $this->plan = Planes::find($id);
    }

    public function render()
    {
        return view('livewire.planes.historial');
    }
}
