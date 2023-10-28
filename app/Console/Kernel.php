<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/*
|-------------------------------------
| Define y programa tareas de Artisan.
|-------------------------------------
*/

class Kernel extends ConsoleKernel
{
    /*
    |-------------------------------------------------------
    | Los comandos Artisan proporcionados por la aplicación.
    |-------------------------------------------------------
    */
    protected $commands = [];

    /*
    |------------------------------------------
    | Registra los comandos para la aplicación.
    |------------------------------------------
    */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
