<?php

namespace App\Http\Livewire\Soluciones;

use App\Models\Problemas;
use App\Models\Soluciones;
use Livewire\Component;

class SolucionesForm extends Component
{
    public Soluciones $solucion;
    public $problemas;
    public $selectedP = Array();

    protected $rules = [
        'solucion.nombre' => 'required|string|min:5',
        'solucion.activo' => ''
    ];

    protected $messages = [
        'solucion.nombre.required' => 'El campo nombre no puede ser nulo',
        'solucion.nombre.min' => 'El nombre debe contener al menos 5 caracteres',
    ];

    public function mount($id){
        if($id == 0){
            $this->solucion = new Soluciones();
            $this->solucion->activo = true;
        }else{
            $this->solucion = Soluciones::find($id);
        }

        $this->solucion->problemas;
        $this->problemas = Problemas::all();
        foreach($this->solucion->problemas as $s):
            $this->selectedP[$s['id']] = true;
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

        $this->solucion->save();
        $this->solucion->problemas()->sync($select);

        session()->flash('message', 'Problema guardado!');
        return redirect()->to('/soluciones');
    }

    public function render()
    {
        return view('livewire.soluciones.soluciones-form');
    }
}
