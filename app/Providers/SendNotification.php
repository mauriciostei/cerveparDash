<?php

namespace App\Providers;

use App\Providers\NewAlert;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\NewAlert  $event
     * @return void
     */
    public function handle(NewAlert $event)
    {
        //
    }
}
