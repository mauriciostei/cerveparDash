<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW public.roles
        AS
        SELECT pu.users_id,
            p.id AS permisos_id,
            p.nombre,
            p.link,
            p.categoria,
            p.icono,
            bool_or(pp.leer) AS leer,
            bool_or(pp.editar) AS editar,
            bool_or(pp.crear) AS crear
        FROM perfiles_users pu
            JOIN perfiles_permisos pp ON pu.perfiles_id = pp.perfiles_id
            JOIN permisos p ON p.id = pp.permisos_id AND p.activo = true
            JOIN perfiles pe ON pe.id = pp.perfiles_id AND pe.activo = true
        GROUP BY pu.users_id, p.id, p.nombre, p.link, p.categoria, p.icono;
        ");

        DB::statement("ALTER TABLE public.roles OWNER TO postgres;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS roles;");
    }
};
