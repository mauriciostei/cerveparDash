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
        CREATE OR REPLACE FUNCTION public.cantidad_anomalias(
            fec_inicio date,
            fec_fin date)
            RETURNS TABLE(id bigint, nombre character varying, ini time without time zone, fin time without time zone, cantidad bigint) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000
        
        AS \$BODY$
                BEGIN
                
                Return query
                
                with
                anomalias as (
                    select *
                    from alertas
                    where cast(created_at as date) between fec_inicio and fec_fin
                )
        
                select t.id
                    , t.nombre
                    , h.inicio
                    , h.fin
                    , (select count(*) from anomalias where cast(created_at as time) between h.inicio and h.fin) cantidad
                from tiers t
                    join horarios h on h.id>0
                ;
                
                END; 
                
        \$BODY$;
        ");

        DB::statement("ALTER FUNCTION public.cantidad_anomalias(date, date) OWNER TO postgres;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP FUNCTION IF EXISTS public.cantidad_anomalias(date, date);");
    }
};
