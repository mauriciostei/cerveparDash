<?php

namespace App\Http\Livewire\Problemas;

use App\Models\Problemas;
use App\Models\Soluciones;
use Livewire\Component;

class ProblemasForm extends Component
{
    public Problemas $problema;
    public $soluciones;
    public $selectedP = Array();

    protected $rules = [
        'problema.nombre' => 'required|string|min:5',
        'problema.activo' => ''
    ];

    protected $messages = [
        'problema.nombre.required' => 'El campo nombre no puede ser nulo',
        'problema.nombre.min' => 'El nombre debe contener al menos 5 caracteres',
    ];

    public function mount($id){
        if($id == 0){
            $this->problema = new Problemas();
            $this->problema->activo = true;
        }else{
            $this->problema = Problemas::find($id);
        }

        $this->problema->soluciones;
        $this->soluciones = Soluciones::all();
        foreach($this->problema->soluciones as $s):
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

        $this->problema->save();
        $this->problema->soluciones()->sync($select);

        session()->flash('message', 'Problema guardado!');
        return redirect()->to('/problemas');
    }

    public function render()
    {
        return view('livewire.problemas.problemas-form');
    }
}
