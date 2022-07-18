<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsuariosList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public function render(){
        return view('livewire.usuarios.usuarios-list', [
            'users' => User::orderBy('id')->paginate(10)
        ]);
    }
}
