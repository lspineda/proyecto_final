<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

/*
|-------------------------------------------------------
| Controlador para la tabla 'users' de la base de datos.
|-------------------------------------------------------
*/

class UserManageController extends Controller
{
    /*
    |----------------------------------------------
    | Devuelve la vista para el modulo de usuarios.
    |----------------------------------------------
    */
    public function index()
    {
        return view('user.user');
    }

    /*
    |----------------------------------------------------------------
    | Realiza una busqueda en la tabla 'users' de la base de datos,
    | utilizando los parámetros recibidos en la solicitud ($request).
    |----------------------------------------------------------------
    */
    public function UserList(Request $request)
    {
        $name = $request->name;
        $email = $request->email;

        $users = User::with('role:id,name')->orderBy('name', 'ASC');

        if ($name != '') {
            $users->where('name', 'LIKE', '%' . $name . '%');
        }

        if ($email != '') {
            $users->where('email', 'LIKE', '%' . $email . '%');
        }

        $users = $users->paginate(10);

        return $users;
    }

    /*
    |----------------------------------------------------------
    | Realiza un INSERT a la tabla 'users' en la base de datos.
    |----------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);

        try {
            $user = new User;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role;
            $user->branch_id = 1;
            $user->save();

            return response()->json(['status' => 'success', 'message' => '¡Usuario agregado!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => '¡Algo salió mal! Por favor, vuelva a intentarlo']);
        }
    }

    /*
    |---------------------------------------------------------------------------------
    | Realiza un SELECT a una fila específica de la tabla 'users' en la base de datos.
    |---------------------------------------------------------------------------------
    */
    public function edit($id)
    {
        return $user = User::find($id);
    }

    /*
    |----------------------------------------------------------------------------------------------
    | Realiza un UPDATE a los datos de una fila específica de la tabla 'users' en la base de datos.
    |----------------------------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'role' => 'required',
        ]);

        try {
            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role;
            $user->update();

            return response()->json(['status' => 'success', 'message' => '¡Usuario actualizado!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => '¡Algo salió mal! Por favor, vuelva a intentarlo']);
        }
    }

    /*
    |---------------------------------------------------------------------------------
    | Realiza un DELETE a una fila específica de la tabla 'users' en la base de datos.
    |---------------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return response()->json(['status' => 'success', 'message' => '¡Usuario eliminado!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => '¡Algo salió mal! Por favor, vuelva a intentarlo']);
        }
    }
}
