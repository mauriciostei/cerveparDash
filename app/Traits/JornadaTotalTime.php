<?php

namespace App\Traits;

trait JornadaTotalTime{

    public function getTotalTime($arr){
        $hh = 0;
        $mm = 0;
        $ss = 0;
        foreach ($arr as $time)
        {
            sscanf( $time, '%d:%d:%d', $hours, $mins, $secs);
            $hh += $hours;
            $mm += $mins;
            $ss += $secs;
        }

        $mm += floor( $ss / 60 ); $ss = $ss % 60;
        $hh += floor( $mm / 60 ); $mm = $mm % 60;
        return sprintf('%02d:%02d:%02d', $hh, $mm, $ss);
    }
    
}