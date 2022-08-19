<?php

namespace App\Http\Livewire\Alertas;

use App\Models\Alertas;
use App\Models\Problemas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Resolucion extends Component
{
    public Alertas $alerta;
    public $soluciones;
    public Problemas $problema;
    public User $usuario;
    public User $authUser;

    protected $rules = [
        'alerta.soluciones_id' => 'required|integer',
        'alerta.observaciones' => 'nullable|string|max:200',
    ];

    protected $messages = [
        'alerta.soluciones_id.required' => 'El problema es requerido',
    ];

    public function mount($id){
        $this->alerta = Alertas::find($id);

        $this->usuario = $this->alerta->users;
        $this->problema = Problemas::find($this->alerta->problemas_id);
        $this->soluciones = $this->problema->soluciones;

        $this->authUser = Auth::user();
        $this->alerta->soluciones_id = 1;
    }

    public function save(){
        $this->validate();

        $this->alerta->fin = now();
        $this->alerta->visible = false;
        $this->alerta->save();

        $r = $this->alerta->recorridos;
        $r->estado = 'Dismiss';
        $r->save();

        session()->flash('message', 'Alerta resuelta!');
        return redirect()->to('/inicio');
    }

    public function render()
    {
        return view('livewire.alertas.resolucion');
    }
}
