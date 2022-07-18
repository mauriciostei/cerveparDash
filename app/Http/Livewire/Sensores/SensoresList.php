<?php

namespace App\Http\Livewire\Sensores;

use App\Models\Sensores;
use Livewire\Component;
use Livewire\WithPagination;

class SensoresList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render(){
        return view('livewire.sensores.sensores-list', [
            'sensores' => Sensores::orderBy('id')->paginate(10)
        ]);
    }
}
