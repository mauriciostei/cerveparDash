<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('horarios')->insert(['inicio' => '08:00:00', 'fin' => '12:00:00']);
        DB::table('horarios')->insert(['inicio' => '12:00:01', 'fin' => '14:00:00']);
        DB::table('horarios')->insert(['inicio' => '14:00:01', 'fin' => '16:00:00']);
        DB::table('horarios')->insert(['inicio' => '16:00:01', 'fin' => '18:00:00']);
        DB::table('horarios')->insert(['inicio' => '18:00:01', 'fin' => '20:00:00']);
        DB::table('horarios')->insert(['inicio' => '20:00:01', 'fin' => '22:00:00']);
    }
}
