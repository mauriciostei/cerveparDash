<?php

namespace App\Providers;

use App\Models\CambiosRecorridos;
use App\Models\Recorridos;
use App\Observers\CambiosRecorridosObserver;
use App\Observers\RecorridosObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        CambiosRecorridos::observe(CambiosRecorridosObserver::class);
        Recorridos::observe(RecorridosObserver::class);
    }
}
