<?php

namespace App\Http\Livewire\Planes;

use App\Models\Choferes;
use App\Models\Planes;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PlanesForm extends Component
{

    public $plan;
    public $choferes;

    public function mount($id){
        $this->plan = Planes::find($id);
        $this->choferes = Choferes::all();
    }

    public function borrar($mov, $chof, $via){
        DB::table('choferes_moviles_planes')->where('planes_id', $this->plan->id)->where('moviles_id', $mov)->where('choferes_id', $chof)->where('viaje', $via)->delete();
        session()->flash('message', 'Plan eliminado!');
        return redirect()->to('/planes/'.$this->plan->id);
    }

    public function render()
    {
        return view('livewire.planes.planes-form');
    }
}