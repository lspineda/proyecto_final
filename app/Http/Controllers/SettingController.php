<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Session;

/*
|--------------------------------------------------------------------------------
| Controlador para la columna 'password' de la tabla 'users' en la base de datos.
|--------------------------------------------------------------------------------
*/

class SettingController extends Controller
{
    /*
    |---------------------------------------------
    | Devuelve la vista para el modulo de ajustes.
    |---------------------------------------------
    */
    public function index()
    {
        return view('setting.change_password');
    }

    /*
    |----------------------------------------------------------------------------------------------------------
    | Realiza un UPDATE a la columna 'password' de una fila específica de la tabla 'users' en la base de datos.
    |----------------------------------------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        // Validamos si estamos recibiendo los datos requeridos.
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $old_password = Auth::user()->password;

        if (Hash::check($request->old_password, $old_password)) {

            $user = User::find(Auth::user()->id);

            $user->password = Hash::make($request->password);

            $user->update();

            Session::flash('message', '¡Contraseña actualizada!');

            return redirect()->back();
        } else {
            Session::flash('message', 'La contraseña anterior no coincide');
            return redirect()->back();
        }
    }
}
