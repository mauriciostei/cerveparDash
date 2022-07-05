<?php

namespace App\Http\Livewire\Sensores;

use App\Models\Puntos;
use App\Models\Sensores;
use Livewire\Component;

class SensoresForm extends Component
{
    public Sensores $sensor;
    public $puntos;

    protected $rules = [
        'sensor.nombre' => 'required|string|min:5',
        'sensor.codigo' => 'required',
        'sensor.activo' => '',
        'sensor.puntos_id' => '',
    ];

    protected $messages = [
        'sensor.nombre.required' => 'El campo nombre no puede ser nulo',
        'sensor.nombre.min' => 'El nombre debe contener al menos 5 caracteres',
        'sensor.codigo.required' => 'El numero de codigo es requerido',
    ];

    public function mount($id){
        if($id == 0){
            $this->sensor = new Sensores();
            $this->sensor->activo = true;
            $this->sensor->puntos_id = 1;
        }else{
            $this->sensor = Sensores::find($id);
        }
        $this->puntos = Puntos::all();
    }

    public function save(){
        $this->validate();

        $this->sensor->save();
        session()->flash('message', 'Sensor guardado!');
        return redirect()->to('/sensores');
    }

    public function render()
    {
        return view('livewire.sensores.sensores-form');
    }
}
