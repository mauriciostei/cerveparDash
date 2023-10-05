<?php

namespace App\Http\Livewire\Causas;

use App\Models\Causas;
use Livewire\Component;
use Livewire\WithPagination;

class CausasList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.causas.causas-list', [
            'causas' => Causas::orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
