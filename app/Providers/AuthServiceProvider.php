<?php

namespace App\Providers;

use App\Models\Permisos;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
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
            return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 1)->first()->leer;
        });

        Gate::define('metricas', function($user){
            return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 2)->first()->leer;
        });


        Gate::define('usuarios_leer', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 3)->first()->leer; });
        Gate::define('perfiles_leer', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 4)->first()->leer; });
        Gate::define('choferes_leer', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 5)->first()->leer; });
        Gate::define('moviles_leer', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 6)->first()->leer; });
        Gate::define('sensores_leer', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 7)->first()->leer; });
        Gate::define('planes_leer', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 8)->first()->leer; });
        Gate::define('problemas_leer', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 9)->first()->leer; });
        Gate::define('soluciones_leer', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 10)->first()->leer; });
        Gate::define('puntos_leer', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 11)->first()->leer; });
        Gate::define('tiers_leer', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 12)->first()->leer; });
        Gate::define('operadoras_leer', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 16)->first()->leer; });

        Gate::define('usuarios_editar', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 3)->first()->editar; });
        Gate::define('perfiles_editar', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 4)->first()->editar; });
        Gate::define('choferes_editar', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 5)->first()->editar; });
        Gate::define('moviles_editar', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 6)->first()->editar; });
        Gate::define('sensores_editar', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 7)->first()->editar; });
        Gate::define('planes_editar', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 8)->first()->editar; });
        Gate::define('problemas_editar', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 9)->first()->editar; });
        Gate::define('soluciones_editar', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 10)->first()->editar; });
        Gate::define('puntos_editar', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 11)->first()->editar; });
        Gate::define('tiers_editar', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 12)->first()->editar; });
        Gate::define('operadoras_editar', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 16)->first()->editar; });

        Gate::define('usuarios_crear', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 3)->first()->crear; });
        Gate::define('perfiles_crear', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 4)->first()->crear; });
        Gate::define('choferes_crear', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 5)->first()->crear; });
        Gate::define('moviles_crear', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 6)->first()->crear; });
        Gate::define('sensores_crear', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 7)->first()->crear; });
        Gate::define('planes_crear', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 8)->first()->crear; });
        Gate::define('problemas_crear', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 9)->first()->crear; });
        Gate::define('soluciones_crear', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 10)->first()->crear; });
        Gate::define('puntos_crear', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 11)->first()->crear; });
        Gate::define('tiers_crear', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 12)->first()->crear; });
        Gate::define('operadoras_crear', function($user){ return DB::table('roles')->where('users_id', $user->id)->where('permisos_id', 16)->first()->crear; });

    }
}
