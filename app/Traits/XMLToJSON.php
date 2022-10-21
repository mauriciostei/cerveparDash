<?php

namespace App\Traits;

trait XMLToJSON{

    public function xmlToJson($request){
        $file = $request->file('anpr_xml');
        $fo = fopen($file, 'r');
        $contenido = fread($fo, filesize($file));
        fclose($fo);

        libxml_use_internal_errors(true);
        return simplexml_load_string($contenido);
    }

}