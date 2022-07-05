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
        CREATE OR REPLACE FUNCTION public.top_desvios(
            fec_inicio date,
            fec_fin date,
            cantidad_moviles integer)
            RETURNS TABLE(tier_id bigint, tier_nombre character varying, movil_id bigint, movil_nombre character varying, hora integer) 
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
                , moviles_id
                , sum(case
                    when fin is null then current_timestamp - inicio
                    else fin - inicio
                end) tiempo
            from recorridos
            where estado = 'OutOfTime'
            and cast(inicio as date) between fec_inicio and fec_fin
            group by tiers_id, moviles_id
        )
        
        select t.id
            , t.nombre
            , m.id
            , m.nombre
            , cast((extract(hour from d.tiempo)*60) + extract(minute from d.tiempo) as integer) desvio
        from desvios d
            join moviles m on m.id = d.moviles_id
            join tiers t on t.id = d.tiers_id
        order by 5 desc
        limit cantidad_moviles
        
        ;
        
        END; 
        \$BODY$;
        ");

        DB::statement("ALTER FUNCTION public.top_desvios(date, date, integer) OWNER TO postgres;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP FUNCTION IF EXISTS public.top_desvios(date, date, integer);");
    }
};
