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
        CREATE OR REPLACE VIEW public.acuraccy
        AS
        with
        plan as (
            SELECT p.id
                , p.fecha
                , cmp.viaje
                , cmp.moviles_id
            FROM planes p
                LEFT JOIN choferes_moviles_planes cmp ON cmp.planes_id = p.id
        )
        ,res as (
            SELECT *
                , (select count(distinct moviles_id) from recorridos where cast(inicio as date) = p.fecha and viaje = p.viaje and moviles_id = p.moviles_id) recorrido
            from plan p
        )
        ,repo as (
            select res.id, res.fecha, count(moviles_id) plan, sum(recorrido) ejecutado
            from res
            group by res.id, res.fecha
        )

        select *, case
            when ejecutado = 0 then 0
            else (ejecutado / plan) * 100
        end porcentaje
        from repo
        ");

        DB::statement("ALTER TABLE public.acuraccy OWNER TO postgres;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS acuraccy;");
    }
};
