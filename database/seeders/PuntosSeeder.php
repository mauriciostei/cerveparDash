<?php

namespace Database\Seeders;

use App\Models\Puntos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = new Puntos();
        $p1->nombre = 'EN RUTA';
        $p1->save();

        $p2 = new Puntos();
        $p2->nombre = 'CONTROL 1';
        $p2->save();

        $p3 = new Puntos();
        $p3->nombre = 'CONTROL 2';
        $p3->save();

        $p4 = new Puntos();
        $p4->nombre = 'DOCKS DE DESCARGA';
        $p4->save();

        $p5 = new Puntos();
        $p5->nombre = 'ENVASES';
        $p5->save();

        $p6 = new Puntos();
        $p6->nombre = 'FIN ENVASES';
        $p6->save();


        // Tier 2
        $p1->tiers()->attach(2, ['viaje' => 1, 'orden' => 1, 'target' => '09:00:00', 'ponderacion' => '20:00:00']);
        $p2->tiers()->attach(2, ['viaje' => 1, 'orden' => 2, 'target' => '00:02:00', 'ponderacion' => '20:00:00']);
        $p3->tiers()->attach(2, ['viaje' => 1, 'orden' => 3, 'target' => '00:02:00', 'ponderacion' => '20:00:00']);
        $p4->tiers()->attach(2, ['viaje' => 1, 'orden' => 4, 'target' => '00:20:00', 'ponderacion' => '20:00:00']);
        $p5->tiers()->attach(2, ['viaje' => 1, 'orden' => 5, 'target' => '00:30:00', 'ponderacion' => '20:00:00']);
        $p6->tiers()->attach(2, ['viaje' => 1, 'orden' => 6, 'target' => '00:00:00', 'ponderacion' => '00:00:00']);

        // Tier 1
        $p2->tiers()->attach(1, ['viaje' => 1, 'orden' => 1, 'target' => '00:04:00', 'ponderacion' => '20:00:00']);
        $p3->tiers()->attach(1, ['viaje' => 1, 'orden' => 2, 'target' => '00:14:00', 'ponderacion' => '20:00:00']);
        $p4->tiers()->attach(1, ['viaje' => 1, 'orden' => 3, 'target' => '00:20:00', 'ponderacion' => '20:00:00']);
        $p5->tiers()->attach(1, ['viaje' => 1, 'orden' => 4, 'target' => '00:28:00', 'ponderacion' => '20:00:00']);
        $p1->tiers()->attach(1, ['viaje' => 1, 'orden' => 5, 'target' => '00:00:00', 'ponderacion' => '00:00:00']);
    }
}
