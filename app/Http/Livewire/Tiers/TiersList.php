<?php

namespace App\Http\Livewire\Tiers;

use App\Models\Tiers;
use Livewire\Component;

class TiersList extends Component
{
    public $tiers;

    public function render()
    {
        $this->tiers = Tiers::all();
        return view('livewire.tiers.tiers-list');
    }
}
