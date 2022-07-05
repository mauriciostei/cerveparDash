<?php

namespace Database\Seeders;

use App\Models\Sensores;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SensoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s = new Sensores();
        $s->puntos_id = 2;
        $s->nombre = 'CONTROL 1 ENTRADA 1';
        $s->codigo = 'C1_in1';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 2;
        $s->nombre = 'CONTROL 1 ENTRADA 2';
        $s->codigo = 'C1_in2';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 1;
        $s->nombre = 'CONTROL 1 SALIDA 1';
        $s->codigo = 'C1_out1';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 1;
        $s->nombre = 'CONTROL 1 SALIDA 2';
        $s->codigo = 'C1_out2';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 3;
        $s->nombre = 'Control 2 carril 1';
        $s->codigo = 'C2_1';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 3;
        $s->nombre = 'Control 2 carril 2';
        $s->codigo = 'C2_2';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 3;
        $s->nombre = 'Control 2 carril 3';
        $s->codigo = 'C2_3';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 4;
        $s->nombre = 'Dock 1';
        $s->codigo = 'Dock 1';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 4;
        $s->nombre = 'Dock 2';
        $s->codigo = 'Dock 2';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 4;
        $s->nombre = 'Dock 3';
        $s->codigo = 'Dock 3';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 4;
        $s->nombre = 'Dock 4';
        $s->codigo = 'Dock 4';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 5;
        $s->nombre = 'ENVASES 1';
        $s->codigo = 'ENVASES 1';
        $s->save();

        $s = new Sensores();
        $s->puntos_id = 6;
        $s->nombre = 'ENVASES 2';
        $s->codigo = 'ENVASES 2';
        $s->save();
        
    }
}
