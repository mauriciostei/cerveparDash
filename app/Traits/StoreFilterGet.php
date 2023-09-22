<?php

namespace App\Traits;

use App\Models\StoreFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait StoreFilterGet{

    public function storeFilterGet($nombre, $tabla){
        $user_id = Auth::user()->id;
        $store = StoreFilter::where('users_id', $user_id)->where('nombre', $nombre)->first();

        if(!$store){
            $store = new StoreFilter();
            $store->users_id = $user_id;
            $store->nombre = $nombre;
            $store->datos = DB::table($tabla)->pluck('id');
            $store->save();
        }

        return json_decode($store->datos);
    }
    
}