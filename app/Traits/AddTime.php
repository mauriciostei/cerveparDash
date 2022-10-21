<?php

namespace App\Traits;

trait AddTime{

    private function addTime($time, $ahora = false){
        $div = explode(':', $time);

        $date = $ahora ? $ahora : date('Y-m-d H:i:s');

        $res = date('Y-m-d H:i:s', strtotime($date.' +'.$div[0].' hours'));
        $res = date('Y-m-d H:i:s', strtotime($res.' +'.$div[1].' minutes'));
        $res = date('Y-m-d H:i:s', strtotime($res.' +'.$div[2].' seconds'));

        return $res;
    }
    
}