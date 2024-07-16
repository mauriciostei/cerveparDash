<?php

namespace App\Http\Livewire\Colaboradores;

use App\Models\Colaboradores;
use Livewire\Component;
use Livewire\WithPagination;

class ColaboradoresList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.colaboradores.colaboradores-list', [
            'colaboradores' => Colaboradores::orderBy('colaboradores.id', 'desc')->paginate(10)
        ]);
    }
}
