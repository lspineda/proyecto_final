<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/*
|--------------------------
| Eventos de la aplicación.
|--------------------------
*/

class EventServiceProvider extends ServiceProvider
{
    /*
    |-------------------------------------
    | Mapeo de eventos para la aplicación.
    |-------------------------------------
    */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
