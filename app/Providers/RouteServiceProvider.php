<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/*
|-------------------------------------------
| Define y carga las rutas de la aplicación.
|-------------------------------------------
*/

class RouteServiceProvider extends ServiceProvider
{
    /*
    |---------------------------------------------------------------------------
    | Este espacio de nombres se aplica a las rutas de los controladores.
    | Además, se establece como el espacio de nombres raíz del generador de URL.
    |---------------------------------------------------------------------------
    */
    protected $namespace = 'App\Http\Controllers';

    /*
    |----------------------------------------------------------------------
    | Define los enlaces de modelos de las rutas, filtros de patrones, etc.
    |----------------------------------------------------------------------
    */
    public function boot()
    {
        parent::boot();
    }

    /*
    |-------------------------------------
    | Define las rutas para la aplicación.
    |-------------------------------------
    */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /*
    |------------------------------------------------------------------
    | Define las rutas "web" para la aplicación.
    | Estas rutas reciben el estado de la sesión, protección CSRF, etc.
    |------------------------------------------------------------------
    */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /*
    |-------------------------------------------
    | Define las rutas "api" para la aplicación.
    |-------------------------------------------
    */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
