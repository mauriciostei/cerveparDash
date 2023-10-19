<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS alertas_tma;");

        DB::statement("
        CREATE OR REPLACE VIEW public.alertas_tma
        AS
        
        with 
        reco as (
            select r.tiers_id, r.moviles_id, r.choferes_id, r.viaje, min(r.id) primero, max(r.id) ultimo
            from recorridos r
            where cast(r.inicio as date) = current_date
                and not exists (
                    select * from alertas where tipos_alertas_id = 2 and alertas.recorridos_id = r.id 
                )
            group by r.tiers_id, r.moviles_id, r.choferes_id, r.viaje
        )
        , datos as (
            select r.*
                , pr.inicio::time without time zone primera
                , (current_timestamp - pr.inicio)::time without time zone AS resultado
                , tv.tiempo_tma
            from reco r
                join recorridos pr on pr.id = r.primero
                join recorridos se on se.id = r.ultimo
                left join tiers_viajes tv ON r.tiers_id = tv.tiers_id AND r.viaje = tv.viajes_id
            where se.fin is null
                AND tv.tiempo_tma > '00:00:00'::time without time zone 
                AND (current_timestamp - pr.inicio) > tv.tiempo_tma
        )

        select d.tiers_id
            , d.moviles_id
            , d.choferes_id
            , d.viaje
            , d.primero recorrido
            , d.ultimo recorrido_ultimo
            , d.primera
            , d.resultado
            , d.tiempo_tma
        from datos d;
        ");

        DB::statement("ALTER TABLE public.alertas_tma OWNER TO postgres;");
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS alertas_tma;");
    }
};
