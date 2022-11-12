<?php

namespace App\Http\Livewire\Puntos;

use App\Models\Puntos;
use Livewire\Component;
use Livewire\WithPagination;

class PuntosList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.puntos.puntos-list', [
            'puntos' => Puntos::orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
