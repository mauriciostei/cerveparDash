<?php

namespace App\Http\Livewire\Ayudantes;

use App\Models\Ayudantes;
use Livewire\Component;
use Livewire\WithPagination;

class AyudantesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $nombre;

    public function render()
    {
        $nom = strtolower(trim($this->nombre));
        return view('livewire.ayudantes.ayudantes-list', [
            'ayudantes' => Ayudantes::whereRaw("lower(nombre) like '%$nom%'")->orderBy('ayudantes.id', 'desc')->paginate(10)
        ]);
    }
}
