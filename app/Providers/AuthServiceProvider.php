<?php

namespace App\Providers;

use App\Models\Ayudantes;
use App\Models\CausaRaiz;
use App\Models\Causas;
use App\Models\Choferes;
use App\Models\Colaboradores;
use App\Models\Limites;
use App\Models\Moviles;
use App\Models\Operadoras;
use App\Models\Perfiles;
use App\Models\Planes;
use App\Models\Problemas;
use App\Models\Puntos;
use App\Models\Sensores;
use App\Models\Soluciones;
use App\Models\Tiers;
use App\Models\User;
use App\Policies\AyudantesPolicy;
use App\Policies\CausasPolicy;
use App\Policies\CausasRaizPolicy;
use App\Policies\ChoferesPolicy;
use App\Policies\ColaboradoresPolicy;
use App\Policies\LimitesPolicy;
use App\Policies\MovilesPolicy;
use App\Policies\OperadorasPolicy;
use App\Policies\PerfilesPolicy;
use App\Policies\PlanesPolicy;
use App\Policies\ProblemasPolicy;
use App\Policies\PuntosPolicy;
use App\Policies\SensoresPolicy;
use App\Policies\SolucionesPolicy;
use App\Policies\TiersPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Perfiles::class => PerfilesPolicy::class,
        Operadoras::class => OperadorasPolicy::class,
        Choferes::class => ChoferesPolicy::class,
        Moviles::class => MovilesPolicy::class,
        Sensores::class => SensoresPolicy::class,
        Planes::class => PlanesPolicy::class,
        Problemas::class => ProblemasPolicy::class,
        Soluciones::class => SolucionesPolicy::class,
        Puntos::class => PuntosPolicy::class,
        Tiers::class => TiersPolicy::class,
        Causas::class => CausasPolicy::class,
        CausaRaiz::class => CausasRaizPolicy::class,
        Limites::class => LimitesPolicy::class,
        Ayudantes::class => AyudantesPolicy::class,
        Colaboradores::class => ColaboradoresPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('inicio', function($user){
            return $user->getPermisosByLink('inicio')->leer;
        });

        Gate::define('metricas', function($user){
            return $user->getPermisosByLink('metricas')->leer;
        });

        Gate::define('controlMoviles', function($user){
            return $user->getPermisosByLink('controlMoviles')->leer;
        });

        Gate::define('metricaAlertas', function($user){
            return $user->getPermisosByLink('metricaAlertas')->leer;
        });

        Gate::define('jornada', function($user){
            return $user->getPermisosByLink('jornada')->leer;
        });

        Gate::define('jornadaT1', function($user){
            return $user->getPermisosByLink('jornadaT1')->leer;
        });

        Gate::define('jornadafa', function($user){
            return $user->getPermisosByLink('jornadafa')->leer;
        });

        Gate::define('jornadaAyudante', function($user){
            return $user->getPermisosByLink('jornadaAyudante')->leer;
        });

        Gate::define('jornadaColaboradores', function($user){
            return $user->getPermisosByLink('jornadaColaboradores')->leer;
        });

        Gate::define('controlPuntos', function($user){
            return $user->getPermisosByLink('controlPuntos')->leer;
        });

        Gate::define('cambiosRecorridos', function($user){
            return $user->getPermisosByLink('cambiosRecorridos')->leer;
        });

        Gate::define('alertasTMA', function($user){
            return $user->getPermisosByLink('alertasTMA')->leer;
        });

        Gate::define('binnacleT2', function($user){
            return $user->getPermisosByLink('binnacleT2')->leer;
        });

        Gate::define('binnacleT1', function($user){
            return $user->getPermisosByLink('binnacleT1')->leer;
        });
    }
}
