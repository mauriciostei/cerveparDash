<?php

namespace Database\Seeders;

use App\Models\Choferes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChoferesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = new Choferes();
        $c->nombre = 'Chofer Anonimo';
        $c->documento = 0;
        $c->save();

        $c = new Choferes();
        $c->nombre = 'Rob Halford';
        $c->documento = 3674839;
        $c->save();

        $c = new Choferes();
        $c->nombre = 'James Simons';
        $c->documento = 932857;
        $c->save();

        $c = new Choferes();
        $c->nombre = 'Bad Bunny';
        $c->documento = 329857;
        $c->save();
    }
}
