<?php

namespace App\Observers;

use App\Models\Aprobaciones;
use App\Models\CambiosRecorridos;
use Illuminate\Support\Facades\Auth;

class CambiosRecorridosObserver
{
    public function created(CambiosRecorridos $cambiosRecorridos)
    {
        $apr = new Aprobaciones();
        $apr->observacion = $cambiosRecorridos->observacion;
        $apr->users_id = Auth::user()->id;
        $apr->aprobacion()->associate($cambiosRecorridos);
        $apr->save();
    }

    public function updated(CambiosRecorridos $cambiosRecorridos)
    {
        //
    }

    public function deleted(CambiosRecorridos $cambiosRecorridos)
    {
        //
    }

    public function restored(CambiosRecorridos $cambiosRecorridos)
    {
        //
    }

    public function forceDeleted(CambiosRecorridos $cambiosRecorridos)
    {
        //
    }
}
