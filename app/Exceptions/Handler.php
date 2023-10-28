<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/*
|----------------------------
| Controlador de excepciones.
|----------------------------
*/

class Handler extends ExceptionHandler
{
    /*
    |----------------------------------------------------
    | Lista de los tipos de excepción que no se reportan.
    |----------------------------------------------------
    */
    protected $dontReport = [];

    /*
    |----------------------------------------------------------------------------
    | Lista de las entradas que nunca se muestran para excepciones de validación.
    |----------------------------------------------------------------------------
    */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /*
    |------------------------
    | Reportar una excepción.
    |------------------------
    */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /*
    |------------------------------------------------
    | Renderizar una excepción en una respuesta HTTP.
    |------------------------------------------------
    */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
