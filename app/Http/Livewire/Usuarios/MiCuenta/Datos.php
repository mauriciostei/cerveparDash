<?php

namespace App\Http\Livewire\Usuarios\MiCuenta;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Datos extends Component
{
    public User $usuario;

    protected $rules = [
        'usuario.name' => 'required|string|min:5',
        'usuario.email' => 'required|email',
    ];

    protected $messages = [
        'usuario.name.required' => 'El campo nombre no puede ser nulo',
        'usuario.name.min' => 'El nombre debe contener al menos 5 caracteres',
        'usuario.email.required' => 'El correo no puede ser nulo',
        'usuario.email.email' => 'Debe contener el formato de correo electrónico',
    ];

    public function save(){
        $this->validate();
        $this->usuario->save();

        session()->flash('message', 'Usuario guardado!');
        return redirect()->to('/MiCuenta');
    }

    public function mount(){
        $this->usuario = Auth::user();
    }

    public function render()
    {
        return view('livewire.usuarios.mi-cuenta.datos');
    }
}
