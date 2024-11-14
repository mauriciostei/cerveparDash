<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("DROP VIEW public.acuraccy");

        DB::statement("
        CREATE OR REPLACE VIEW public.acuraccy
        AS

        with
        recorrido as (
            select cast(inicio as date) fecha, moviles_id
            from recorridos
            where tiers_id = 2
            group by cast(inicio as date), moviles_id
        ),
        plan as (
            select p.fecha, cmp.moviles_id
            from planes p
                join choferes_moviles_planes cmp on p.id = cmp.planes_id
                join moviles m on cmp.moviles_id = m.id
            where m.tiers_id = 2
            group by p.fecha, cmp.moviles_id
        ),
        resultado as (
            select p.fecha, count(p.moviles_id) planificado, count(r.moviles_id) resultado
            from plan p
                left join recorrido r on p.fecha = r.fecha and p.moviles_id = r.moviles_id
            group by p.fecha
        )

        select p.id,
            p.fecha,
            r.planificado plan,
            r.resultado ejecutado,
            COALESCE(r.resultado * 100 / nullif(r.planificado,0), 0::bigint) AS porcentaje
        from planes p
            left join resultado r on p.fecha = r.fecha
        ;
        ");

        DB::statement("ALTER TABLE public.acuraccy OWNER TO postgres;");
    }

    public function down()
    {
        DB::statement("DROP VIEW public.acuraccy");
    }
};
