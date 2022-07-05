<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\Perfiles;
use App\Models\User;
use Livewire\Component;

class UsuariosForm extends Component
{
    public User $usuario;
    public $perfiles;
    public $selectedP = Array();

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

    public function mount($id){
        $this->usuario = ($id == 0) ? new User() : User::find($id);
        $this->usuario->perfiles;
        $this->perfiles = Perfiles::all();
        foreach($this->usuario->perfiles as $p):
            $this->selectedP[$p['id']] = true;
        endforeach;
    }

    public function save(){
        $this->validate();

        $select = [];
        foreach($this->selectedP as $key => $value):
            if($value){
                array_push($select, $key);
            }
        endforeach;

        if(!isset($this->usuario->id)){
            $this->usuario->password = bcrypt('12345');
        }
        
        $this->usuario->save();
        $this->usuario->perfiles()->sync($select);

        session()->flash('message', 'Usuario guardado!');

        return redirect()->to('/usuarios');
    }

    public function render()
    {
        return view('livewire.usuarios.usuarios-form');
    }
}
