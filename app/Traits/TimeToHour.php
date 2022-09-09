<?php

namespace App\Traits;

trait TimeToHour{

    public function TimeToHour($time){
        $str = strtotime($time);
        return date('H:i:s', $str);
    }
}