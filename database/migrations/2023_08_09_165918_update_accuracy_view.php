<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS acuraccy;");

        DB::statement("
        CREATE OR REPLACE VIEW public.acuraccy
        AS
        WITH plan AS (
                SELECT p.id,
                    p.fecha,
                    p.activo,
                    p.created_at,
                    p.updated_at,
                    ( SELECT count(DISTINCT cmp.moviles_id) AS count
                        FROM choferes_moviles_planes cmp
                            JOIN moviles m ON m.id = cmp.moviles_id
                        WHERE cmp.planes_id = p.id AND m.tiers_id = 2) AS plan
                FROM planes p
                ), plan_movil AS (
                SELECT p.fecha,
                    cmp.moviles_id
                FROM planes p
                    JOIN choferes_moviles_planes cmp ON p.id = cmp.planes_id
                ), ejecutado AS (
                SELECT pm.fecha,
                    count(DISTINCT r.moviles_id) AS ejecutado
                FROM recorridos r
                    JOIN plan_movil pm ON r.inicio::date = pm.fecha AND r.moviles_id = pm.moviles_id
                WHERE r.tiers_id = 2
                GROUP BY pm.fecha
                ), res AS (
                SELECT p.id,
                    p.fecha,
                    p.plan,
                    COALESCE(e.ejecutado, 0::bigint) AS ejecutado,
                    COALESCE(e.ejecutado * 100 / p.plan, 0::bigint) AS porcentaje
                FROM plan p
                    LEFT JOIN ejecutado e ON p.fecha = e.fecha
                where p.plan > 0
                )
        SELECT res.id,
            res.fecha,
            res.plan,
            res.ejecutado,
            res.porcentaje
        FROM res;
        ");

        DB::statement("ALTER TABLE public.acuraccy OWNER TO postgres;");
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS acuraccy;");
    }
};
