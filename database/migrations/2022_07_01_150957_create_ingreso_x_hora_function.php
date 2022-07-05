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
        CREATE OR REPLACE FUNCTION public.ingreso_x_hora(
            fec_inicio date,
            fec_fin date)
            RETURNS TABLE(id bigint, nombre character varying, ini time without time zone, fin time without time zone, moviles bigint) 
            LANGUAGE 'plpgsql'
            COST 100
            VOLATILE PARALLEL UNSAFE
            ROWS 1000
        
        AS \$BODY$
        BEGIN
        
        Return query
        
        with
        datos as (
            select tiers_id, moviles_id, cast(min(inicio) as time) primero
            from recorridos
            where cast(inicio as date) between fec_inicio and fec_fin
            group by tiers_id, moviles_id
        )
        
        select t.id
            , t.nombre
            , h.inicio
            , h.fin
            , (select count(*) from datos d where d.tiers_id = t.id and d.primero between h.inicio and h.fin) moviles
        from tiers t
            join horarios h on h.id>0
        
        ;
        
        END; 
        \$BODY$;
        ");

        DB::statement('ALTER FUNCTION public.ingreso_x_hora(date, date) OWNER TO postgres;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP FUNCTION IF EXISTS public.ingreso_x_hora(date, date);');
    }
};
