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

        $per1 = new Permisos();
        $per1->nombre = 'Inicio';
        $per1->link = 'inicio';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Métricas';
        $per1->link = 'metricas';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Status';
        $per1->link = 'controlMoviles';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Alertas';
        $per1->link = 'metricaAlertas';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Jornada';
        $per1->link = 'jornada';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Usuarios';
        $per1->link = 'usuariosList';
        $per1->categoria = 'Accesos';
        $per1->icono = 'person';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Perfiles';
        $per1->link = 'perfilesList';
        $per1->categoria = 'Accesos';
        $per1->icono = 'desktop_access_disabled';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Choferes';
        $per1->link = 'choferesList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'transfer_within_a_station';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Móviles';
        $per1->link = 'movilesList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'taxi_alert';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Sensores';
        $per1->link = 'sensoresList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'photo_camera';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Planes';
        $per1->link = 'planesList';
        $per1->categoria = 'Ejecución';
        $per1->icono = 'task';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Problemas';
        $per1->link = 'problemasList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'info';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Soluciones';
        $per1->link = 'solucionesList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'task_alt';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Puntos';
        $per1->link = 'puntosList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'location_searching';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Tiers';
        $per1->link = 'tiersList';
        $per1->categoria = 'Ejecución';
        $per1->icono = 'map';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Alertas';
        $per1->link = 'metricaAlertas';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'O.L.';
        $per1->link = 'operadorasList';
        $per1->categoria = 'MasterData';
        $per1->icono = 'local_shipping';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Jornada T1';
        $per1->link = 'jornadaT1';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Jornada T2';
        $per1->link = 'jornada';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);

        $per1 = new Permisos();
        $per1->nombre = 'Control Puntos';
        $per1->link = 'controlPuntos';
        $per1->categoria = 'Dashboards';
        $per1->icono = 'dashboard';
        $per1->save();
        $per1->perfiles()->attach($p1, ['leer' => true, 'crear' => true, 'editar' => true]);
    }
}
