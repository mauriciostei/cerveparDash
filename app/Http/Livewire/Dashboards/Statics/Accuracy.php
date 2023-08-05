<?php

namespace App\Http\Livewire\Dashboards\Statics;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Accuracy extends Component
{
    public $porcentaje;
    public $plan;
    public $ejecutado;

    public function mount(){
        $accuracy = DB::table('acuraccy')->whereDate('fecha', date('Y-m-d'))->first();
        $this->porcentaje = $accuracy->porcentaje;
        $this->plan = $accuracy->plan;
        $this->ejecutado = $accuracy->ejecutado;
    }

    public function render()
    {
        return view('livewire.dashboards.statics.accuracy');
    }
}
