<?php

namespace App\Http\Livewire\Aprobaciones;

use App\Models\Aprobaciones;
use Livewire\Component;

class Procesar extends Component
{
    public $aprobacion;

    public function rules(){
        return [
            'aprobacion.observacion_resolucion' => '',
        ];
    }

    public function mount($id){
        $this->aprobacion = Aprobaciones::find($id);
    }

    public function rechazar(){
        $this->validate();

        $this->aprobacion->aprobacion->rechazar();
        $this->aprobacion->estado = 3;
        $this->aprobacion->fecha_resolucion = now();
        $this->aprobacion->save();

        session()->flash('message', 'Solicitud Rechazada con éxito!');

        return redirect()->to('/inicio');
    }

    public function aprobar(){
        $this->validate();
        
        $this->aprobacion->aprobacion->aprobar();
        $this->aprobacion->estado = 2;
        $this->aprobacion->fecha_resolucion = now();
        $this->aprobacion->save();

        session()->flash('message', 'Solicitud Aprobada con éxito!');

        return redirect()->to('/inicio');
    }

    public function render()
    {
        return view('livewire.aprobaciones.procesar');
    }
}
