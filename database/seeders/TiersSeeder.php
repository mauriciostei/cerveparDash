<?php

namespace Database\Seeders;

use App\Models\Tiers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t = new Tiers();
        $t->nombre = 'Tier 1';
        $t->save();

        $t = new Tiers();
        $t->nombre = 'Tier 2';
        $t->save();
    }
}
