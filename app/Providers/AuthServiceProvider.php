<?php

namespace App\Providers;

use App\Models\Choferes;
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
use App\Policies\ChoferesPolicy;
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
            return $user->getPermisos(1)->leer;
        });

        Gate::define('metricas', function($user){
            return $user->getPermisos(2)->leer;
        });

        Gate::define('controlMoviles', function($user){
            return $user->getPermisos(13)->leer;
        });

        Gate::define('metricaAlertas', function($user){
            return $user->getPermisos(14)->leer;
        });

        Gate::define('jornada', function($user){
            return $user->getPermisos(15)->leer;
        });

        Gate::define('jornadaT1', function($user){
            return $user->getPermisos(17)->leer;
        });

        Gate::define('controlPuntos', function($user){
            return $user->getPermisos(18)->leer;
        });

        Gate::define('cambiosRecorridos', function($user){
            return $user->getPermisos(19)->leer;
        });
    }
}
