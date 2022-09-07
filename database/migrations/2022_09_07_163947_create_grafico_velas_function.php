<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE FUNCTION public.grafico_velas(
            fec_inicio date,
            fec_fin date)
            RETURNS TABLE(tiers_id bigint, puntos_id bigint, puntos_nombre character varying, cantidad_max bigint, cantidad_min bigint, cantidad_avg bigint, tiempo_max interval, tiempo_min interval, tiempo_avg interval) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000
        
        AS \$BODY$
                BEGIN
                
                Return query
                
                with
                data as (
                    select cast(a.created_at as date) fecha, r.tiers_id, p.id puntos_id, p.nombre puntos_nombre, count(*) cantidad, avg(a.fin - a.created_at) horas
                    from alertas a
                        join recorridos r on r.id = a.recorridos_id
                        join puntos p on p.id = r.puntos_id
                    where cast(a.created_at as date) between fec_inicio and fec_fin
                        and a.fin is not null
                    group by cast(a.created_at as date), r.tiers_id, p.id, p.nombre
                )
                ,res as (
                    select d.tiers_id, d.puntos_id
                        , max(cantidad) cant_max, min(cantidad) cant_min, cast(avg(cantidad) as bigint) cant_avg
                        , max(horas) tie_max, min(horas) tie_min, avg(horas) tie_avg
                    from data d
                    group by d.tiers_id, d.puntos_id
                )

                select t.id, p.id, p.nombre,
                    res.cant_max, res.cant_min, res.cant_avg,
                    res.tie_max, res.tie_min, res.tie_avg
                from tiers t
                    join puntos p on p.id > 0
                    left join res on res.tiers_id = t.id and res.puntos_id = p.id
                
                ;
                
                END; 
                
        \$BODY$;
        ");

        DB::statement("ALTER FUNCTION public.grafico_velas(date, date) OWNER TO postgres;");
    }


    public function down()
    {
        DB::statement("DROP FUNCTION IF EXISTS public.grafico_velas(date, date);");
    }
};
