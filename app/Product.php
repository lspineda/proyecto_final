<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
|-------------------------------------------------------------------
| Representa el modelo de la tabla 'categories' de la base de datos.
|-------------------------------------------------------------------
*/

class Product extends Model
{
  /*
  |-----------------------------------------------------------------------------
  | Relación con el modelo Category.
	| Si no hay una categoría asociada, se establece una categoría predeterminada.
  |-----------------------------------------------------------------------------
  */
  public function category()
  {
    return $this->belongsTo('App\Category')->withDefault([
      'id' => 0,
      'name' => 'Unknown Category',
    ]);
  }

  /*
  |------------------------------
  | Relación con el modelo Stock.
  |------------------------------
  */
  public function stock()
  {
    return $this->hasMany('App\Stock');
  }

  /*
  |------------------------------------
  | Relación con el modelo SellDetails.
  |------------------------------------
  */
  public function sell_details()
  {
    return $this->hasMany('App\SellDetails');
  }
}
