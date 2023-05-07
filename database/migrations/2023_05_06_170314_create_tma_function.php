<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
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
                data as (
                    select r.*, r.fin - r.inicio as total
                    from recorridos r
                    where cast(r.inicio as date) between fec_inicio and fec_fin
                        and r.tiers_id = tier
                        and r.fin is not null
                ),
                resultado as (
                    select g.turno, DATE_TRUNC('second', avg(d.total))::time as media
                    from data d
                        join grupo g on d.inicio::time between g.inicio and g.fin
                    group by g.turno
                )

                select g.*, COALESCE(r.media, '00:00:00') media, COALESCE(extract(EPOCH from r.media), 0) seconds
                from grupo g
                    left join resultado r on g.turno = r.turno
                order by g.fin
                ;
                
                END; 
                
        \$BODY$;
        ");

        DB::statement("ALTER FUNCTION public.tma(date, date, integer) OWNER TO postgres;");
    }

    public function down()
    {
        DB::statement("DROP FUNCTION IF EXISTS public.tma(date, date, integer);");
    }
};
