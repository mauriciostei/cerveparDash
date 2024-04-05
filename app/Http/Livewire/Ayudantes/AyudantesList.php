<?php

namespace App\Http\Livewire\Ayudantes;

use App\Models\Ayudantes;
use Livewire\Component;
use Livewire\WithPagination;

class AyudantesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.ayudantes.ayudantes-list', [
            'ayudantes' => Ayudantes::orderBy('ayudantes.id', 'desc')->paginate(10)
        ]);
    }
}
