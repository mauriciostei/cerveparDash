<?php

namespace App\Http\Livewire\Planes;

use App\Models\Choferes;
use App\Models\Planes;
use App\Models\Recorridos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PlanesForm extends Component
{

    public $plan;
    public $choferes;
    public $recorridos;

    public function mount($id){
        $this->plan = Planes::find($id);
        $this->choferes = Choferes::all();
        $this->recorridos = Recorridos::whereDate('inicio', date('Y-m-d'))->get();
    }

    public function borrar($mov, $chof, $via){
        DB::table('choferes_moviles_planes')->where('planes_id', $this->plan->id)->where('moviles_id', $mov)->where('choferes_id', $chof)->where('viaje', $via)->delete();

        $this->plan->users_id = Auth::user()->id;
        $this->plan->ultima_actualizacion = now();
        $this->plan->save();

        session()->flash('message', 'Plan eliminado!');
        return redirect()->to('/planes/'.$this->plan->id);
    }

    public function render(){
        return view('livewire.planes.planes-form');
    }
}
