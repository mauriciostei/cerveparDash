<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\User;
use Livewire\Component;

class UsuariosList extends Component
{
    public $users;
    
    public function render()
    {
        $this->users = User::all();
        return view('livewire.usuarios.usuarios-list');
    }
}
