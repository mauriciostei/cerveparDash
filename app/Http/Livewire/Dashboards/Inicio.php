<?php

namespace App\Http\Livewire\Dashboards;

use App\Models\Recorridos;
use App\Models\Tiers;
use App\Traits\DifTime;
use App\Traits\TimeToInt;
use Livewire\Component;

class Inicio extends Component
{
    use TimeToInt;
    use DifTime;

    public $recorridos;
    public $t1 = [];
    public $t2 = [];
    public $tiers;

    public $showTimeline = true;

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.inicio');
    }

    public function getInfo(){
        $this->recorridos = Recorridos::
            whereDate('inicio', date('Y-m-d'))
            ->where('fin', null)
            ->orderBy('id', 'desc')
        ->get();

        $this->tiers = Tiers::all();

        $this->t1['OnTime'] = $this->recorridos->where('tiers_id', 1)->where('estado', 'OnTime')->count();
        $this->t1['OutOfTime'] = $this->recorridos->where('tiers_id', 1)->where('estado', 'OutOfTime')->count();
        $this->t1['total'] = $this->t1['OnTime'] + $this->t1['OutOfTime'];
        $this->t1['%'] = $this->t1['OnTime']==0 ? 0 : round(($this->t1['OnTime'] / $this->t1['total']) * 100, 0);

        $this->t2['OnTime'] = $this->recorridos->where('tiers_id', 2)->where('estado', 'OnTime')->count();
        $this->t2['OutOfTime'] = $this->recorridos->where('tiers_id', 2)->where('estado', 'OutOfTime')->count();
        $this->t2['total'] = $this->t2['OnTime'] + $this->t2['OutOfTime'];
        $this->t2['%'] = $this->t2['OnTime']==0 ? 0 : round(($this->t2['OnTime'] / $this->t2['total']) * 100, 0);
    }
}
