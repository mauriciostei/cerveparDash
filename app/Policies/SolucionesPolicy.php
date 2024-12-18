<?php

namespace App\Policies;

use App\Models\Soluciones;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SolucionesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->getPermisos(10)->leer;
        return $user->getPermisosByLink('solucionesList')->leer;
    }

    public function view(User $user, Soluciones $soluciones)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(10)->crear;
        return $user->getPermisosByLink('solucionesList')->crear;
    }

    public function update(User $user, Soluciones $soluciones)
    {
        // return $user->getPermisos(10)->editar;
        return $user->getPermisosByLink('solucionesList')->editar;
    }

    public function delete(User $user, Soluciones $soluciones)
    {
        //
    }

    public function restore(User $user, Soluciones $soluciones)
    {
        //
    }

    public function forceDelete(User $user, Soluciones $soluciones)
    {
        //
    }
}
