<?php

namespace App\Http\Controllers;

use Session;
use Auth;

/*
|----------------------------------------
| Controlador para la sesión del usuario.
|----------------------------------------
*/

class UserController extends Controller
{
  /*
  |------------------------------------------------------------------
  | Termina la sesión del usuario y redirecciona a la ruta principal.
  |------------------------------------------------------------------
  */
  public function logout()
  {
    Auth::logout();
    Session::forget('side_menu');
    return redirect('/');
  }
}
