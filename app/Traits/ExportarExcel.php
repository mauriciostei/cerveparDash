<?php

namespace App\Traits;

trait ExportarExcel{

    public function getFile($fileName, $columns, $datos, $columnsTaken){

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel;",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Expires"             => "0"
        );

        $callback = function() use($datos, $columns, $columnsTaken) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,"\t");

            foreach ($datos as $item):
                $line = Array();
                foreach($columnsTaken as $taken):
                    $line[] = $item[$taken];
                endforeach;
                fputcsv($file, $line,"\t");
            endforeach;
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}