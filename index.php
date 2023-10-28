<?php

/*
|----------------------------------------------------------------------------
| Define la constante LARAVEL_START que almacena el valor de microtime(true),
| que representa el tiempo que tarda en ejecutarse ciertas partes del código.
|----------------------------------------------------------------------------
*/

define('LARAVEL_START', microtime(true));

/*
|-------------------------------------------------------------------------------------
| Carga automáticamente las clases necesarias de la aplicación generadas por Composer.
|-------------------------------------------------------------------------------------
*/

require __DIR__ . '/vendor/autoload.php';

/*
|----------------------------------
| Inicializa la aplicación Laravel.
|----------------------------------
*/

$app = require_once __DIR__ . '/bootstrap/app.php';

/*
|----------------------------------------------------
| Maneja la solicitud entrante a través del kernel de
| Laravel y envía la respuesta de vuelta al cliente.
|----------------------------------------------------
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

/*
|-------------------------------
| Finaliza el kernel de Laravel.
|-------------------------------
*/

$kernel->terminate($request, $response);
