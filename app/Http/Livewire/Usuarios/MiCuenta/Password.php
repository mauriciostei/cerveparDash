<?php

namespace App\Http\Livewire\Usuarios\MiCuenta;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Password extends Component
{
    public User $usuario;

    public $password;
    public $newpassword1;
    public $newpassword2;

    protected $rules = [
        'password' => 'required|string|current_password',
        'newpassword1' => 'required|min:5',
        'newpassword2' => 'required|min:5|same:newpassword1',
    ];

    protected $messages = [
        'password.required' => 'Introduzca su contraseña actual',
        'password.current_password' => 'Contraseña introducida invalida',
        'newpassword1.required' => 'Favor introduzca su contraseña nueva',
        'newpassword1.min' => 'el valor de la contraseña nueva no puede ser nulo',
        'newpassword2.required' => 'Favor introduzca su contraseña nueva',
        'newpassword2.min' => 'el valor de la contraseña nueva no puede ser nulo',
        'newpassword2.same' => 'las contraseñas introducidas no coinciden',
    ];

    public function save(){
        $this->validate();
        
        $this->usuario->password = bcrypt($this->newpassword1);
        $this->usuario->save();

        auth()->logout();
        return redirect('/sign-in');
    }

    public function mount(){
        $this->usuario = Auth::user();
    }

    public function render()
    {
        return view('livewire.usuarios.mi-cuenta.password');
    }
}
