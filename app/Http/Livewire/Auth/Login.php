<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{

    public $email='';
    public $password='';

    protected $rules= [
        'email' => 'required|email',
        'password' => 'required'

    ];

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function mount() {
        //$this->fill(['email' => 'admin@test.com', 'password' => '12345']);    
    }
    
    public function store()
    {
        $attributes = $this->validate();

        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Usuario o contraseña inválidos'
            ]);
        }

        session()->regenerate();

        return redirect()->route('inicio');

    }
}
