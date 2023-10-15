<?php

namespace App\Policies;

use App\Models\Causas;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CausasPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->getPermisos(20)->leer;
        return $user->getPermisosByLink('causasList')->leer;
    }

    public function view(User $user, Causas $causas)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(20)->crear;
        return $user->getPermisosByLink('causasList')->crear;
    }

    public function update(User $user, Causas $causas)
    {
        // return $user->getPermisos(20)->editar;
        return $user->getPermisosByLink('causasList')->editar;
    }

    public function delete(User $user, Causas $causas)
    {
        //
    }

    public function restore(User $user, Causas $causas)
    {
        //
    }

    public function forceDelete(User $user, Causas $causas)
    {
        //
    }
}
