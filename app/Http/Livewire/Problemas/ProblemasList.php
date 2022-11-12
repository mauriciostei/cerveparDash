<?php

namespace App\Http\Livewire\Problemas;

use App\Models\Problemas;
use Livewire\Component;
use Livewire\WithPagination;

class ProblemasList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        return view('livewire.problemas.problemas-list', [
            'problemas' => Problemas::orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
