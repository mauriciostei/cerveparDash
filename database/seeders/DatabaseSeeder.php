<?php

namespace Database\Seeders;

use App\Models\Planes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            PerfilesSeeder::class,
            TiersSeeder::class,
            // PuntosSeeder::class,
            // SensoresSeeder::class,
            // MovilesSeeder::class,
            // ChoferesSeeder::class,
            // PlanesSeeder::class,
                //RecorridosSeeder::class,
            HorariosSeeder::class,
        ]);

        $plan = new Planes();
        $plan->fecha = date('Y-m-d');
        $plan->save();
    }
}
