<?php

namespace App\Http\Livewire\Dashboards\Statics;

use Livewire\Component;

class TierResume extends Component
{
    public $tier;
    public $ontime;
    public $outoftime;
    public $percentage;
    public $image;
    public $total;

    public function mount($tier, $ontime, $outoftime, $percentage, $image, $total){
        $this->tier = $tier;
        $this->ontime = $ontime;
        $this->outoftime = $outoftime;
        $this->percentage = $percentage;
        $this->image = $image;
        $this->total = $total;
    }

    public function render()
    {
        return view('livewire.dashboards.statics.tier-resume');
    }
}
