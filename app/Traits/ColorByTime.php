<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait ColorByTime{

    private function getColor($time, $tiers_id){

        $hour = DB::table('tiers_hours')
            ->where('tiers_id', $tiers_id)
            ->where('corte', '>=', $time)
            ->orderBy('corte', 'asc')
            ->first()
        ;

        return isset($hour) ? $hour->color : 'text-danger';
    }
    
}