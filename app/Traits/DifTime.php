<?php

namespace App\Traits;

use DateTime;

trait DifTime{

    public function difTime($time){
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($time);
        $interval = $datetime1->diff($datetime2);
        $elapsed = $interval->format('%H:%I:%S');

        return $elapsed;
    }

    public function difTimeFrom($time, $from){
        $datetime1 = new DateTime($from);
        $datetime2 = new DateTime($time);
        $interval = $datetime1->diff($datetime2);
        $elapsed = $interval->format("(%d) %H:%I:%S");

        return $elapsed;
    }

    public function difTimeFromOnlyTime($time, $from){
        $datetime1 = new DateTime($from);
        $datetime2 = new DateTime($time);
        $interval = $datetime1->diff($datetime2);
        $elapsed = $interval->format("%H:%I:%S");

        return $elapsed;
    }
    
}