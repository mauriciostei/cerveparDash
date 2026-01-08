<?php

namespace App\Http\Livewire\Alertas;

use App\Models\Alertas;
use App\Models\CausaRaiz;
use App\Models\Causas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AlertasTma extends Component
{
    public Alertas $alerta;
    public $causas;
    public $causaRaiz;

    public function rules(){
        return [
            'alerta.causas_id' => 'required|exists:causas,id',
            'alerta.causa_raizs_id' => 'required|exists:causa_raizs,id',
            'alerta.observaciones' => 'required|max:200'
        ];
    }

    public function mount(Alertas $alerta){
        $this->alerta = $alerta;
        $this->causas = Causas::all()->where('activo', true);
        $this->causaRaiz = CausaRaiz::all()->where('activo', true);
    }

    public function save(){
        $this->validate();

        $this->alerta->visible = false;
        $this->alerta->users_id = Auth::user()->id;
        $this->alerta->inicio = now();
        $this->alerta->fin = now();
        $this->alerta->save();

        session()->flash('message', 'Alerta gestionada!');
        return redirect()->to('/inicio');
    }

    public function render()
    {
        return view('livewire.alertas.alertas-tma');
    }
}
