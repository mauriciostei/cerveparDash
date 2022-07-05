<?php

namespace Database\Seeders;

use App\Models\Planes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pl = new Planes();
        $pl->fecha = date('Y-m-d');
        $pl->save();
    }
}
