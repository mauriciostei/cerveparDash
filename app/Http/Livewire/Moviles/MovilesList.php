<?php

namespace App\Http\Livewire\Moviles;

use App\Models\Moviles;
use Livewire\Component;
use Livewire\WithPagination;

class MovilesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $nombre;

    public function render(){
        $nom = strtoupper(trim($this->nombre));
        return view('livewire.moviles.moviles-list', ['moviles' => Moviles::where('nombre', 'like', '%'.$nom.'%')->paginate(10)]);
    }
}
