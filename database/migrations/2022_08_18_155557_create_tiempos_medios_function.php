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
        DB::statement("DROP FUNCTION IF EXISTS public.tiempo_medios(date, date);");
        
        DB::statement("
        CREATE OR REPLACE FUNCTION public.tiempo_medios(
            fec_inicio date,
            fec_fin date)
            RETURNS TABLE(id bigint, tmr interval, tmi interval)  
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000
        
        AS \$BODY$
                BEGIN
                
                Return query
                
                with
                agrupado as (
                    select tiers_id, puntos_id
                        , avg(fin - inicio) tiempos
                    from recorridos
                    where cast(inicio as date) between fec_inicio and fec_fin
                        and fin is not null
                    group by tiers_id, puntos_id
                )

                select tiers_id
                    , sum(
                        case when puntos_id = 1 then tiempos end
                    ) tmr
                    , sum(
                        case when puntos_id <> 1 then tiempos end
                    ) tmi
                from agrupado
                group by tiers_id

                ;
                
                END; 
                
        \$BODY$;
        ");

        DB::statement("ALTER FUNCTION public.tiempo_medios(date, date) OWNER TO postgres;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP FUNCTION IF EXISTS public.tiempo_medios(date, date);");
    }
};
