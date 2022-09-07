<?php

namespace App\Traits;

trait TimeToInt{

    public function timeToInt($time){
        $arr = explode(':', $time);
        $hour = intval($arr[0]) * 3600;
        $min = intval($arr[1]) * 60;
        return intval($arr[2]) + $min + $hour;
    }

}