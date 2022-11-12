<?php

namespace App\Http\Livewire\Soluciones;

use App\Models\Soluciones;
use Livewire\Component;
use Livewire\WithPagination;

class SolucionesList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.soluciones.soluciones-list', [
            'soluciones' => Soluciones::orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
