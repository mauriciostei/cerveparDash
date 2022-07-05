<?php

namespace App\Http\Livewire\config;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class sidebar extends Component
{
    public $menu = [];
    public $subMenu = [];

    public function mount(){
        $usuario = Auth::user();

        $this->menu = DB::table('roles')->where('users_id', $usuario->id)->get();
        $this->subMenu = $this->menu->unique('categoria');
    }

    public function render(){
        return view('livewire.config.sidebar');
    }
}