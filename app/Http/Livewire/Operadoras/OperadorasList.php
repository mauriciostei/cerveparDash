<?php

namespace App\Http\Livewire\Operadoras;

use App\Models\Operadoras;
use Livewire\Component;
use Livewire\WithPagination;

class OperadorasList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.operadoras.operadoras-list', [
            'operadoras' => Operadoras::orderBy('operadoras.id', 'desc')->paginate(10)
        ]);
    }
}
