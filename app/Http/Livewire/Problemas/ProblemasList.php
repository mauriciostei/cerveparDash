<?php

namespace App\Http\Livewire\Problemas;

use App\Models\Problemas;
use Livewire\Component;

class ProblemasList extends Component
{
    public $problemas;

    public function render()
    {
        $this->problemas = Problemas::all();
        return view('livewire.problemas.problemas-list');
    }
}
