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
    }
}
