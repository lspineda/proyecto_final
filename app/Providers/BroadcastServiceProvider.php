<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

/*
|----------------------------
| Transmisión en tiempo real.
|----------------------------
*/

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
