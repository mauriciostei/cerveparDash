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
        DB::statement("
        CREATE OR REPLACE FUNCTION public.desvio_medio(
            fec_inicio date,
            fec_fin date)
            RETURNS TABLE(tier_id bigint, tier_nombre character varying, punto_id bigint, punto_nombre character varying, desvio integer) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000
        
        AS \$BODY$
                BEGIN
                
                Return query
                
        with
        desvios as (
            select tiers_id
                , puntos_id
                , case
                    when fin is null then current_timestamp - inicio
                    else fin - inicio
                end tiempo
            from recorridos
            where estado = 'OutOfTime'
            and cast(inicio as date) between fec_inicio and fec_fin
        )
        ,resumen as (
            select d.tiers_id
                , d.puntos_id
                , cast(avg( (extract(hour from d.tiempo)*60) + (extract(minute from d.tiempo)) ) as integer) tiempo
            from desvios d
            group by d.tiers_id, d.puntos_id
        )
        
        select t.id
            , t.nombre
            , p.id
            , p.nombre
            , case when r.tiempo is null then 0
                else r.tiempo
            end desvio
        from tiers t
            join puntos p on p.id>0
            left join resumen r on r.tiers_id = t.id and r.puntos_id = p.id;
            
                END; 
                
        \$BODY$;
        ");

        DB::statement("ALTER FUNCTION public.desvio_medio(date, date) OWNER TO postgres;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP FUNCTION IF EXISTS public.desvio_medio(date, date);");
    }
};
