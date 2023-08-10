<?php

namespace App\Http\Livewire\Dashboards\Statics;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Accuracy extends Component
{
    public $porcentaje = 0;
    public $plan = 0;
    public $ejecutado = 0;

    public function mount(){
        $accuracy = DB::table('acuraccy')->whereDate('fecha', date('Y-m-d'))->first();
        if($accuracy){
            $this->porcentaje = $accuracy->porcentaje;
            $this->plan = $accuracy->plan;
            $this->ejecutado = $accuracy->ejecutado;
        }
    }

    public function render()
    {
        return view('livewire.dashboards.statics.accuracy');
    }
}
