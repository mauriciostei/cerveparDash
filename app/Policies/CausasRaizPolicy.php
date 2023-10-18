<?php

namespace App\Policies;

use App\Models\CausaRaiz;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CausasRaizPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->getPermisos(20)->leer;
        return $user->getPermisosByLink('causasList')->leer;
    }

    public function view(User $user, CausaRaiz $causaRaiz)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(20)->crear;
        return $user->getPermisosByLink('causasList')->crear;
    }

    public function update(User $user, CausaRaiz $causaRaiz)
    {
        // return $user->getPermisos(20)->editar;
        return $user->getPermisosByLink('causasList')->editar;
    }

    public function delete(User $user, CausaRaiz $causaRaiz)
    {
        //
    }

    public function restore(User $user, CausaRaiz $causaRaiz)
    {
        //
    }

    public function forceDelete(User $user, CausaRaiz $causaRaiz)
    {
        //
    }
}
