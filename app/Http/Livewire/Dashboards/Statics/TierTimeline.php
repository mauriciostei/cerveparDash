<?php

namespace App\Http\Livewire\Dashboards\Statics;

use App\Models\Tiers;
use Livewire\Component;

class TierTimeline extends Component
{
    public $tiers;
    public $recorridos;
    public $viaje;

    public function mount($tier, $recorridos){
        $this->tiers = Tiers::find($tier);
        $this->recorridos = $recorridos;
        $this->viaje = 1;
    }

    public function cambiarViaje(){
        $this->viaje = ($this->viaje == 1) ? 2 : 1;
    }

    public function render()
    {
        return view('livewire.dashboards.statics.tier-timeline');
    }
}
