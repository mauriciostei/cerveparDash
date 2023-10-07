<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS alertas_tma;");

        DB::statement("
        CREATE OR REPLACE VIEW public.alertas_tma
        AS
        WITH datos AS (
          SELECT recorridos.tiers_id,
            recorridos.moviles_id,
            recorridos.viaje,
            min(recorridos.id) AS recorrido,
            min(recorridos.inicio)::time without time zone AS primera,
            (now()::time without time zone - min(recorridos.inicio)::time without time zone)::time without time zone AS resultado
           FROM recorridos
           WHERE recorridos.inicio::date = CURRENT_DATE
           GROUP BY recorridos.tiers_id, recorridos.moviles_id, recorridos.viaje
        )
        , evaluado AS (
          SELECT d.tiers_id,
            d.moviles_id,
            d.viaje,
            d.recorrido,
            d.primera,
            d.resultado,
            tv.tiempo_tma
          FROM datos d
            LEFT JOIN tiers_viajes tv ON d.tiers_id = tv.tiers_id AND d.viaje = tv.viajes_id
          WHERE tv.tiempo_tma > '00:00:00'::time without time zone AND d.resultado > tv.tiempo_tma
            and not exists (
              select *
              from recorridos
              where cast(inicio as date) = current_date
                and moviles_id = d.moviles_id
                and viaje = d.viaje
                and inicio = fin
            )
        )
        , resultado AS (
          SELECT e.tiers_id,
            e.moviles_id,
            e.viaje,
            e.recorrido,
            e.primera,
            e.resultado,
            e.tiempo_tma
          FROM evaluado e
            LEFT JOIN alertas al ON e.recorrido = al.recorridos_id AND al.tipos_alertas_id = 2
          WHERE al.id IS NULL
        )
        
        SELECT resultado.tiers_id,
          resultado.moviles_id,
          resultado.viaje,
          resultado.recorrido,
          resultado.primera,
          resultado.resultado,
          resultado.tiempo_tma
        FROM resultado;
        ");

        DB::statement("ALTER TABLE public.alertas_tma OWNER TO postgres;");
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS alertas_tma;");
    }
};
