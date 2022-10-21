<?php

namespace App\Http\Livewire\Usuarios\MiCuenta;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Datos extends Component
{
    use WithFileUploads;

    public User $usuario;
    public $avatar;

    protected $rules = [
        'usuario.name' => 'required|string|min:5',
        'usuario.email' => 'required|email',
        'avatar' => 'nullable|image|max:10240',
    ];

    protected $messages = [
        'usuario.name.required' => 'El campo nombre no puede ser nulo',
        'usuario.name.min' => 'El nombre debe contener al menos 5 caracteres',
        'usuario.email.required' => 'El correo no puede ser nulo',
        'usuario.email.email' => 'Debe contener el formato de correo electrónico',
    ];

    public function save(){
        $this->validate();

        if($this->avatar){
            $this->usuario->avatar = $this->avatar->store('avatars', 'real_public');
        }

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
