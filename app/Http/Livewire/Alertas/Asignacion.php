<?php

namespace App\Http\Livewire\Alertas;

use App\Models\Alertas;
use App\Models\Problemas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Asignacion extends Component
{
    public Alertas $alerta;
    public $problemas;

    protected $rules = [
        'alerta.problemas_id' => 'required',
        'alerta.observaciones' => 'string',
    ];

    protected $messages = [
        'alerta.problemas_id.required' => 'El problema es requerido',
    ];

    public function mount($id){
        $this->alerta = Alertas::find($id);
        $this->problemas = Problemas::all();
    }

    public function save(){
        $this->validate();

        $this->alerta->users_id = Auth::user()->id;
        $this->alerta->inicio = now();
        $this->alerta->save();

        session()->flash('message', 'Alerta asignada!');
        return redirect()->to('/alertas/'.$this->alerta->id);
    }

    public function render()
    {
        return view('livewire.alertas.asignacion');
    }
}
