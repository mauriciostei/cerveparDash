<?php

namespace App\Http\Livewire\Puntos;

use App\Models\Puntos;
use Livewire\Component;

class PuntosForm extends Component
{
    public Puntos $punto;

    protected $rules = [
        'punto.nombre' => 'required|string|min:5',
        'punto.minimo' => 'required|date_format:H:i:s',
        'punto.maximo' => 'required|date_format:H:i:s|after:punto.minimo',
        'punto.tiempos_financieros' => 'required|bool',
        'punto.tiempos_fisicos' => 'required|bool',
        'punto.tipo_tiempo' => 'required|string',
        'punto.activo' => ''
    ];

    protected $messages = [
        'punto.nombre.required' => 'El campo nombre no puede ser nulo',
        'punto.nombre.min' => 'El nombre debe contener al menos 5 caracteres',
    ];

    public function mount($id){
        if($id == 0){
            $this->punto = new Puntos();
            $this->punto->activo = true;
            $this->punto->tiempos_financieros = false;
            $this->punto->tiempos_fisicos = false;
        }else{
            $this->punto = Puntos::find($id);
        }
    }

    public function save(){
        $this->validate();

        $this->punto->save();

        session()->flash('message', 'Punto guardado!');
        return redirect()->to('/puntos');
    }

    public function render()
    {
        return view('livewire.puntos.puntos-form');
    }
}
