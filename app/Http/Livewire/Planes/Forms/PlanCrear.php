<?php

namespace App\Http\Livewire\Planes\Forms;

use App\Models\Choferes;
use App\Models\Moviles;
use App\Models\Planes;
use App\Models\PlanHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PlanCrear extends Component
{
    public $plan;

    // Form para agregar uno
    public $movil = 0;
    public $chofer = 0;
    public $viaje = 1;

    // Listas necesarias
    public $moviles;
    public $choferes;

    protected $rules = [
        'movil' => 'required|int',
        'chofer' => 'required|int',
        'viaje' => 'required|int|lte:2|gte:1',
    ];

    protected $messages = [
        'viaje.lte' => 'El viaje no puede ser superior a 2',
        'viaje.gte' => 'El viaje no puede ser menor a 1',
    ];

    public function updated($property){
        $this->validate();
    }

    public function mount($id){
        $this->plan = Planes::find($id);
        $this->plan->moviles;

        $this->moviles = Moviles::where('activo', true)->get();
        $this->choferes = Choferes::where('activo', true)->get();
    }

    public function agregar(){
        $this->validate();

        $movil = Moviles::find($this->movil);
        $validate = DB::table('choferes_moviles_planes')->where('planes_id', $this->plan->id)->where('moviles_id', $this->movil)->where('viaje', $this->viaje)->first();
        if($validate){
            return $this->addError('movil', "Ya existe una planificación de $movil->nombre para el viaje $this->viaje");
        }

        $chofer = Choferes::find($this->chofer);
        if($chofer->tiers_id == 2){
            $validate = DB::table('choferes_moviles_planes')->where('planes_id', $this->plan->id)->where('choferes_id', $this->chofer)->where('viaje', $this->viaje)->first();
            if($validate){
                return $this->addError('chofer', "Ya existe una planificación de $chofer->nombre para el viaje $this->viaje");
            }
        }

        $this->plan->users_id = Auth::user()->id;
        $this->plan->ultima_actualizacion = now();
        $this->plan->save();

        $this->plan->moviles()->attach($this->movil, ['choferes_id' => $this->chofer, 'viaje' => $this->viaje, 'hora_esperada' => null, 'ayudantes_id' => $chofer->ayudantes_id]);

        PlanHistory::create([
            'users_id' => Auth::user()->id,
            'planes_id' => $this->plan->id,
            'tipo' => "Agregado Manualmente al TIER $movil->tiers_id"
        ]);

        session()->flash('message', 'Plan guardado!');
        return redirect()->to('/planes/'.$this->plan->id);
    }

    public function render()
    {
        return view('livewire.planes.forms.plan-crear');
    }
}
