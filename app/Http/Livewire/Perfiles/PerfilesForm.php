<?php

namespace App\Http\Livewire\Perfiles;

use App\Models\Aprobables;
use App\Models\Perfiles;
use App\Models\Permisos;
use Livewire\Component;

class PerfilesForm extends Component
{
    public Perfiles $perfil;
    public $permisos;
    public $selectedLeer = Array();
    public $selectedCrear = Array();
    public $selectedEditar = Array();

    public $aprobables;
    public $selectedAprobables = Array();

    public $select;

    protected $rules = [
        'perfil.nombre' => 'required|string|min:5',
        'perfil.activo' => ''
    ];

    protected $messages = [
        'perfil.nombre.required' => 'El campo nombre no puede ser nulo',
        'perfil.nombre.min' => 'El nombre debe contener al menos 5 caracteres',
    ];

    public function mount($id){
        if($id == 0){
            $this->perfil = new Perfiles();
            $this->perfil->activo = true;
        }else{
            $this->perfil = Perfiles::find($id);
        }

        $this->aprobables = Aprobables::where('activo', true)->get();
        foreach($this->perfil->aprobables as $ap):
            $this->selectedAprobables[$ap['id']] = true;
        endforeach;

        $this->permisos = Permisos::all();
        foreach($this->perfil->permisos as $p):
            $this->selectedLeer[$p['id']] = $p->pivot->leer;
            $this->selectedCrear[$p['id']] = $p->pivot->crear;
            $this->selectedEditar[$p['id']] = $p->pivot->editar;
        endforeach;
    }

    public function save(){
        $this->validate();

        $this->select = [];
        foreach($this->permisos as $per):
            $this->select[$per->id] = [
                'leer' => array_key_exists($per->id, $this->selectedLeer) ? $this->selectedLeer[$per->id] : false
                , 'crear' => array_key_exists($per->id, $this->selectedCrear) ? $this->selectedCrear[$per->id] : false
                , 'editar' => array_key_exists($per->id, $this->selectedEditar) ? $this->selectedEditar[$per->id] : false
            ];
        endforeach;

        $select = [];
        foreach($this->selectedAprobables as $key => $value):
            if($value){ array_push($select, $key); }
        endforeach;
        
        $this->perfil->save();
        $this->perfil->permisos()->sync($this->select);
        $this->perfil->aprobables()->sync($select);

        session()->flash('message', 'Perfil guardado!');

        return redirect()->to('/perfiles');
    }

    public function render()
    {
        return view('livewire.perfiles.perfiles-form');
    }
}
