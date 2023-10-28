<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;

/*
|---------------------------------------------------------
| Controlador para la tabla 'vendors' de la base de datos.
|---------------------------------------------------------
*/

class VendorController extends Controller
{
    /*
    |----------------------------------
    | Devuelve la vista para el modulo.
    |----------------------------------
    */
    public function index()
    {
        return view('vendor.vendor');
    }

    /*
    |----------------------------------------------------------------
    | Realiza una busqueda en la tabla 'vendors' de la base de datos,
    | utilizando el parámetro recibido en la solicitud ($request).
    |----------------------------------------------------------------
    */
    public function Vendor(Request $request)
    {
        $vendor = Vendor::orderBy('id', 'desc');

        if ($request->name != '') {
            $vendor->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->email != '') {
            $vendor->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->phone != '') {
            $vendor->where('phone', 'LIKE', '%' . $request->phone . '%');
        }

        $vendor = $vendor->paginate(10);

        return $vendor;
    }

    /*
    |------------------------------------------------------------
    | Realiza un INSERT a la tabla 'vendors' en la base de datos.
    |------------------------------------------------------------
    */
    public function store(Request $request)
    {
        // Validamos si estamos recibiendo los datos requeridos.
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|unique:vendors',
            'phone' => 'required|unique:vendors'
        ]);

        try {
            $vendor = new Vendor;

            $vendor->name = $request->name;
            $vendor->email = $request->email;
            $vendor->phone = $request->phone;
            $vendor->address = $request->address;
            $vendor->save();

            return response()->json(['status' => 'success', 'message' => '¡Proveedor agregado!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => '¡Algo salió mal! Por favor, vuelva a intentarlo']);
        }
    }

    /*
    |-----------------------------------------------------------------------------------
    | Realiza un SELECT a una fila específica de la tabla 'vendors' en la base de datos.
    |-----------------------------------------------------------------------------------
    */
    public function edit(Vendor $supplier)
    {
        return $supplier;
    }

    /*
    |------------------------------------------------------------------------------------------------
    | Realiza un UPDATE a los datos de una fila específica de la tabla 'vendors' en la base de datos.
    |------------------------------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        // Validamos si estamos recibiendo los datos requeridos.
        $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'phone' => 'required'
        ]);

        try {
            $supplier = Vendor::find($id);
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->update();

            return response()->json(['status' => 'success', 'message' => '¡Proveedor actualizado!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => '¡Algo salió mal! Por favor, vuelva a intentarlo']);
        }
    }

    /*
    |-----------------------------------------------------------------------------------
    | Realiza un DELETE a una fila específica de la tabla 'vendors' en la base de datos.
    |-----------------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        try {
            $data = Vendor::find($id);

            $data->delete();

            return response()->json(['status' => 'success', 'message' => '¡Proveedor eliminado!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => '¡Algo salió mal! Por favor, vuelva a intentarlo']);
        }
    }
}
