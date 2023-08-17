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
        return $user->getPermisos(12)->leer;
    }

    public function view(User $user, Tiers $tiers)
    {
        //
    }

    public function create(User $user)
    {
        return $user->getPermisos(12)->crear;
    }

    public function update(User $user, Tiers $tiers)
    {
        return $user->getPermisos(12)->editar;
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
