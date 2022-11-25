<?php

namespace Database\Seeders;

use App\Models\Perfiles;
use App\Models\Permisos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = new Perfiles();
        $p1->nombre = 'SuperAdmin';
        $p1->save();
        $p1->users()->attach([1,2]);

        // $p2 = new Perfiles();
        // $p2->nombre = 'admin';
        // $p2->save();
        // $p2->users()->attach([3,4,5]);

        // $p3 = new Perfiles();
        // $p3->nombre = 'Logístico';
        // $p3->save();
        // $p3->users()->attach([6,7,8,9]);

        // $p4 = new Perfiles();
        // $p4->nombre = 'Warehouse';
        // $p4->save();
        // $p4->users()->attach([10,11,12,13]);

        $per1 = new Permisos();
        $per1->nombre = 'Inicio';
        $per1->link = 'inicio';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p3, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p4, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Métricas';
        $per1->link = 'metricas';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p3, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p4, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Status';
        $per1->link = 'controlMoviles';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p3, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p4, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Alertas';
        $per1->link = 'metricaAlertas';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p3, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p4, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Jornada';
        $per1->link = 'jornada';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p3, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p4, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Usuarios';
        $per1->link = 'usuariosList';
        $per1->categoria = 'Accesos';
        $per1->icono = 'person';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Perfiles';
        $per1->link = 'perfilesList';
        $per1->categoria = 'Accesos';
        $per1->icono = 'desktop_access_disabled';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Choferes';
        $per1->link = 'choferesList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'transfer_within_a_station';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Móviles';
        $per1->link = 'movilesList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'taxi_alert';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p3, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p4, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Sensores';
        $per1->link = 'sensoresList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'photo_camera';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Planes';
        $per1->link = 'planesList';
        $per1->categoria = 'Ejecución';
        $per1->icono = 'task';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p3, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Problemas';
        $per1->link = 'problemasList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'info';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Soluciones';
        $per1->link = 'solucionesList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'task_alt';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Puntos';
        $per1->link = 'puntosList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'location_searching';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p3, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p4, ['leer' => true, 'crear' => false, 'editar' => false]);

        $per1 = new Permisos();
        $per1->nombre = 'Tiers';
        $per1->link = 'tiersList';
        $per1->categoria = 'Ejecución';
        $per1->icono = 'map';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
        // $per1->perfiles()->attach($p2, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p3, ['leer' => true, 'crear' => false, 'editar' => false]);
        // $per1->perfiles()->attach($p4, ['leer' => true, 'crear' => false, 'editar' => false]);
    }
}
