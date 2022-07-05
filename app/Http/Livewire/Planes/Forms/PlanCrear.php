<?php

namespace App\Http\Livewire\Planes\Forms;

use App\Models\Choferes;
use App\Models\Moviles;
use App\Models\Planes;
use Livewire\Component;

class PlanCrear extends Component
{
    public $plan;

    // Form para agregar uno
    public $movil = 1;
    public $chofer = 1;
    public $viaje = 1;

    // Listas necesarias
    public $moviles;
    public $choferes;

    protected $rules = [
        'movil' => 'required',
        'chofer' => 'required',
        'viaje' => 'required',
    ];

    public function mount($id){
        $this->plan = Planes::find($id);
        $this->plan->moviles;

        $this->moviles = Moviles::all();
        $this->choferes = Choferes::all();
    }

    public function agregar(){
        $this->plan->moviles()->attach($this->movil, ['choferes_id' => $this->chofer, 'viaje' => $this->viaje]);
        session()->flash('message', 'Plan guardado!');
        return redirect()->to('/planes/'.$this->plan->id);
    }

    public function render()
    {
        return view('livewire.planes.forms.plan-crear');
    }
}
