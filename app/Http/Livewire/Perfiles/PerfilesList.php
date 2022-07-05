<?php

namespace App\Http\Livewire\Perfiles;

use App\Models\Perfiles;
use Livewire\Component;

class PerfilesList extends Component
{
    public $perfiles;

    public function render()
    {
        $this->perfiles = Perfiles::all();
        return view('livewire.perfiles.perfiles-list');
    }
}
