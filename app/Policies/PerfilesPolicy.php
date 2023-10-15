<?php

namespace App\Policies;

use App\Models\Perfiles;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerfilesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->getPermisos(4)->leer;
        return $user->getPermisosByLink('perfilesList')->leer;
    }

    public function view(User $user, Perfiles $perfiles)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(4)->crear;
        return $user->getPermisosByLink('perfilesList')->crear;
    }

    public function update(User $user, Perfiles $perfiles)
    {
        // return $user->getPermisos(4)->editar;
        return $user->getPermisosByLink('perfilesList')->editar;
    }

    public function delete(User $user, Perfiles $perfiles)
    {
        //
    }

    public function restore(User $user, Perfiles $perfiles)
    {
        //
    }

    public function forceDelete(User $user, Perfiles $perfiles)
    {
        //
    }
}
