<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            PerfilesSeeder::class,
            // TiersSeeder::class,
            // PuntosSeeder::class,
            // SensoresSeeder::class,
            // MovilesSeeder::class,
            // ChoferesSeeder::class,
            PlanesSeeder::class,
            // RecorridosSeeder::class,
            HorariosSeeder::class,
        ]);
    }
}
