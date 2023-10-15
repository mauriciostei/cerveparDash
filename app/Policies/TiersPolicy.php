<?php

namespace App\Policies;

use App\Models\Tiers;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TiersPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->getPermisos(12)->leer;
        return $user->getPermisosByLink('tiersList')->leer;
    }

    public function view(User $user, Tiers $tiers)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(12)->crear;
        return $user->getPermisosByLink('tiersList')->crear;
    }

    public function update(User $user, Tiers $tiers)
    {
        // return $user->getPermisos(12)->editar;
        return $user->getPermisosByLink('tiersList')->editar;
    }

    public function delete(User $user, Tiers $tiers)
    {
        //
    }

    public function restore(User $user, Tiers $tiers)
    {
        //
    }

    public function forceDelete(User $user, Tiers $tiers)
    {
        //
    }
}
