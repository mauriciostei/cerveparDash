<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new User(); $u->name = 'admin'; $u->email = 'admin@test.com'; $u->password = bcrypt('admin123'); $u->save();
        $u = new User(); $u->name = 'Erika Adrián'; $u->email = 'erika.adrian@blueocean.com.py'; $u->password = bcrypt('12345'); $u->save();
        // $u = new User(); $u->name = 'Viviana Gonzalez'; $u->email = 'vgfernan@cervepar.com.py'; $u->password = bcrypt('12345'); $u->save();
        // $u = new User(); $u->name = 'Blas Barúa'; $u->email = 'blabarua@cervepar.com.py'; $u->password = bcrypt('12345'); $u->save();
        // $u = new User(); $u->name = 'Ana González'; $u->email = 'acmtalav@cervepar.com.py'; $u->password = bcrypt('12345'); $u->save();
        // $u = new User(); $u->name = 'Solange Rojas'; $u->email = 'solrojas@cervepar.com.py'; $u->password = bcrypt('12345'); $u->save();
        // $u = new User(); $u->name = 'Raúl Galeano'; $u->email = 'agaleano@cervepar.com.py'; $u->password = bcrypt('12345'); $u->save();
        // $u = new User(); $u->name = 'Martín Durán'; $u->email = 'martidur@cervepar.com.py'; $u->password = bcrypt('12345'); $u->save();
        // $u = new User(); $u->name = 'Juan Rigoni'; $u->email = 'jurigoni@cervepar.com.py'; $u->password = bcrypt('12345'); $u->save();
        // $u = new User(); $u->name = 'Javier Ojeda'; $u->email = 'jiogaona@cervepar.com.py'; $u->password = bcrypt('12345'); $u->save();
        // $u = new User(); $u->name = 'Enrique Ortíz'; $u->email = 'eortizto@cervepar.com.py'; $u->password = bcrypt('12345'); $u->save();
        // $u = new User(); $u->name = 'Derlis Núñez'; $u->email = 'dernunez@cervepar.com.py'; $u->password = bcrypt('12345'); $u->save();
        // $u = new User(); $u->name = 'Alcides Centurión'; $u->email = 'alcenturion@cervepar.com.py'; $u->password = bcrypt('12345'); $u->save();
    }
}
