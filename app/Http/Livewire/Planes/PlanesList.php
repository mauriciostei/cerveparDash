<?php

namespace App\Http\Livewire\Planes;

use App\Models\Planes;
use Livewire\Component;
use Livewire\WithPagination;

class PlanesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.planes.planes-list', [
            'planes' => Planes::orderBy('planes.fecha', 'desc')->paginate(10)
        ]);
    }
}
