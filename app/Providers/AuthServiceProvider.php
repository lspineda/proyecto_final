<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/*
|--------------------------
| Autorización y políticas.
|--------------------------
*/

class AuthServiceProvider extends ServiceProvider
{
    /*
    |--------------------------------------------
    | Asignación de políticas para la aplicación.
    |--------------------------------------------
    */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
