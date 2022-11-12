<?php

namespace App\Http\Livewire\Choferes;

use App\Models\Choferes;
use Livewire\Component;
use Livewire\WithPagination;

class ChoferesList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.choferes.choferes-list', [
            'choferes' => Choferes::orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
