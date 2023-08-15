<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP FUNCTION IF EXISTS public.tma(date, date, integer);");

        DB::statement("
        CREATE OR REPLACE FUNCTION public.tma(
            fec_inicio date,
            fec_fin date,
            tier integer
            )
            RETURNS TABLE(inicio time without time zone, fin time without time zone, turno text, media time without time zone, seconds numeric) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000
        
        AS \$BODY$
                BEGIN
                
                Return query
                
                with
                grupo as (
                    select '22:00:00'::time inicio, '06:00:00'::time fin, 'Noche' turno
                    union
                    select '06:00:00', '14:00:00', 'Mañana'
                    union
                    select '14:00:00', '22:00:00', 'Tarde'
                ),
				grupo_recorrido as (
                    select '22:00:00'::time inicio, '23:59:59'::time fin, 'Noche' turno
                    union
					select '00:00:01'::time inicio, '06:00:00'::time fin, 'Noche' turno
                    union
                    select '06:00:00', '14:00:00', 'Mañana'
                    union
                    select '14:00:00', '22:00:00', 'Tarde'
                ),
                movement as (
                    select g.turno, r.moviles_id, r.choferes_id, sum(r.fin - r.inicio) as total
                    from recorridos r
                        join grupo_recorrido g on r.inicio::time between g.inicio and g.fin
                    where cast(r.inicio as date) between fec_inicio and fec_fin
                        and r.tiers_id = tier
                        and r.fin is not null
                    group by g.turno, r.moviles_id, r.choferes_id
                ),
                resultado as (
                    select m.turno, DATE_TRUNC('second', avg(m.total))::time as media
                    from movement m
                    group by m.turno
                )
                
                select g.*, COALESCE(r.media, '00:00:00') media, cast(COALESCE(extract(EPOCH from r.media), 0) as numeric) seconds
                from grupo g
                    left join resultado r on g.turno = r.turno
                order by g.fin
                ;
                
                END; 
                
        \$BODY$;
        ");

        DB::statement("ALTER FUNCTION public.tma(date, date, integer) OWNER TO postgres;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP FUNCTION IF EXISTS public.tma(date, date, integer);");
    }
};
