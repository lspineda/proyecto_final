<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Product;
use App\Vendor;
use App\SellDetails;
use App\Category;
use Illuminate\Http\Request;
use Auth;

/*
|--------------------------------------------------------
| Controlador para la tabla 'stocks' de la base de datos.
|--------------------------------------------------------
*/

class StockController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Devuelve la vista para el modulo de existencias. Recopilando datos de las
  | tablas 'vendors', 'categories' y 'products' para mostrar en la vista.
  |--------------------------------------------------------------------------
  */
  public function index()
  {
    $vendor = Vendor::orderBy('name', 'asc')->get();
    $category = Category::orderBy('name', 'asc')->get();
    $product = Product::orderBy('name', 'asc')->get();
    return view('stock.stock', [
      'vendor' => $vendor,
      'category' => $category,
      'product' => $product,
    ]);
  }

  /*
  |----------------------------------------------------------------
  | Realiza una busqueda en la tabla 'stocks' de la base de datos,
  | utilizando los parámetros recibidos en la solicitud ($request).
  |----------------------------------------------------------------
  */
  public function StockList(Request $request)
  {
    $stock = Stock::with(
      [
        'product' => function ($query) {
          $query->select('id', 'name');
        },
        'vendor' => function ($query) {
          $query->select('id', 'name');
        },
        'user' => function ($query) {
          $query->select('id', 'name');
        },
        'category' => function ($query) {
          $query->select('id', 'name');
        }
      ]
    )->orderBy('updated_at', 'desc');

    if ($request->category != '') {
      $stock->where('category_id', '=', $request->category);
    }

    if ($request->product != '') {
      $stock->where('product_id', '=', $request->product);
    }

    if ($request->vendor != '') {
      $stock->where('vendor_id', '=', $request->vendor);
    }

    $stock = $stock->paginate(10);

    return $stock;
  }

  /*
  |----------------------------------------------------------------
  | Realiza una busqueda en la tabla 'stocks' de la base de datos,
  | utilizando como parámetro el ID del producto.
  |----------------------------------------------------------------
  */
  public function ChalanList($id)
  {
    $chalan = Stock::where('product_id', '=', $id)
      ->where('current_quantity', '>', 0)
      ->orderBy('updated_at', 'desc')
      ->get();

    return $chalan;
  }

  /*
  |-----------------------------------------------------------
  | Realiza un INSERT a la tabla 'stocks' en la base de datos.
  |-----------------------------------------------------------
  */
  public function store(Request $request)
  {
    // Validamos si estamos recibiendo los datos requeridos.
    $request->validate([
      'product' => 'required',
      'vendor' => 'required',
      'category' => 'required',
      'quantity' => 'required|integer',
      'buying_price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
      'selling_price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
    ]);

    try {
      $stock = new Stock;
      $stock->category_id = $request->category;
      $stock->product_id = $request->product;
      $stock->product_code = time();
      $stock->vendor_id = $request->vendor;
      $stock->user_id = Auth::user()->id;
      $stock->buying_price = $request->buying_price;
      $stock->selling_price = $request->selling_price;
      $stock->chalan_no = date('Y-m-d');
      $stock->stock_quantity = $request->quantity;
      $stock->current_quantity = $request->quantity;
      $stock->discount = 0;
      $stock->note = $request->note;
      $stock->status = 1;

      $stock->save();

      Stock::where('product_id', '=', $request->product)
        ->where('current_quantity', '>', 0)
        ->update(['selling_price' => $request->selling_price]);

      return response()->json(['status' => 'success', 'message' => '¡Productos agregados a existencias!']);
    } catch (\Exception $e) {
      return $e;
      return response()->json(['status' => 'error', 'message' => '¡Algo salió mal! Por favor, vuelva a intentarlo']);
    }
  }

  /*
  |----------------------------------------------------------------------------------
  | Realiza un SELECT a una fila específica de la tabla 'stocks' en la base de datos.
  |----------------------------------------------------------------------------------
  */
  public function show(Stock $stock)
  {
    return $stock;
  }

  public function edit($stock)
  {
    return $stock = Stock::with('product')->where('id', '=', $stock)->first();
  }

  /*
  |----------------------------------------------------------------------------------
  | Realiza un DELETE a una fila específica de la tabla 'stocks' en la base de datos.
  |----------------------------------------------------------------------------------
  */
  public function destroy($id)
  {
    $check = SellDetails::where('stock_id', '=', $id)->count();

    if ($check > 0) {
      return response()->json(['status' => 'error', 'message' => 'Esta entrada tiene registro de ventas, debe eliminar los productos vendidos primero']);
    }

    try {
      Stock::where('id', '=', $id)->delete();
      return response()->json(['status' => 'success', 'message' => '¡Entrada eliminada!']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => '¡Algo salió mal! Por favor, vuelva a intentarlo']);
    }
  }
}
