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
            RETURNS TABLE(id bigint, tml interval, tmr interval, tmi interval) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000
        
        AS \$BODY$
                        BEGIN
                        
                        Return query
                        
                        with
                        data as(
                            select tiers_id
                                , puntos_id
                                , avg(fin - inicio) tiempos
                            from recorridos
                            where cast(inicio as date) between fec_inicio and fec_fin
                                and fin is not null
                            group by tiers_id, puntos_id
                        )
        
                        select t.id
                            , COALESCE(sum(case when tipo_tiempo = 'tml' then tiempos end), '00:00:00') tml
                            , COALESCE(sum(case when tipo_tiempo = 'tmr' then tiempos end), '00:00:00') tmr
                            , COALESCE(sum(case when tipo_tiempo = 'tmi' then tiempos end), '00:00:00') tmi
                        from tiers t
                            left join data d on d.tiers_id = t.id
                            left join puntos p on p.id = d.puntos_id
                        group by t.id
        
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
