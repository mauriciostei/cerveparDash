<?php

namespace App\Http\Livewire\Choferes;

use App\Models\Ayudantes;
use App\Models\Choferes;
use App\Models\Operadoras;
use App\Models\Tiers;
use App\Models\UserChoferes;
use Exception;
use Livewire\Component;

class ChoferesForm extends Component
{
    public Choferes $chofer;
    public $tiers;
    public $operadoras;
    public $ayudantes;

    public function rules(){
        return [
            'chofer.nombre' => 'required|string|min:5',
            'chofer.documento' => 'required',
            'chofer.tiers_id' => 'required',
            'chofer.operadoras_id' => '',
            'chofer.ayudantes_id' => 'exclude_if:ayudantes_id,null|unique:choferes,ayudantes_id'.($this->chofer->id > 0 ? ",".$this->chofer->id : ""),
            'chofer.activo' => '',
        ];
    }

    protected $messages = [
        'chofer.nombre.required' => 'El campo nombre no puede ser nulo',
        'chofer.nombre.min' => 'El nombre debe contener al menos 5 caracteres',
        'chofer.documento.required' => 'El numero de documento es requerido',
        'chofer.ayudantes_id' => 'Este ayudante se encuentra actualmente asignado a otro chofer',
    ];

    public function updated($property){
        $this->validateOnly($property);
    }

    public function mount($id){
        if($id == 0){
            $this->chofer = new Choferes();
            $this->chofer->activo = true;
        }else{
            $this->chofer = Choferes::find($id);
        }
        $this->tiers = Tiers::all();
        $this->operadoras = Operadoras::where('activo', true)->get();
        $this->ayudantes = Ayudantes::where('activo', true)->get();
    }

    public function save(){
        $this->validate();

        if(!$this->chofer->ayudantes_id): $this->chofer->ayudantes_id = null; endif;

        $this->chofer->save();

        try{
            $existe = UserChoferes::where('document', $this->chofer->documento)->first();
            if($existe){
                $existe->document = $this->chofer->documento;
                $existe->name = $this->chofer->nombre;
                $existe->save();
            }else{
                $chofer = new UserChoferes();
                $chofer->document = $this->chofer->documento;
                $chofer->name = $this->chofer->nombre;
                $chofer->password = bcrypt('12345');
                $chofer->save();
            }
        } catch(Exception $ex){}


        session()->flash('message', 'Chofer guardado!');
        return redirect()->to('/choferes');
    }

    public function render()
    {
        return view('livewire.choferes.choferes-form');
    }
}
