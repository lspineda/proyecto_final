<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
|---------------------------------------------------------------------
| Representa el modelo de la tabla 'sell_details' de la base de datos.
|---------------------------------------------------------------------
*/

class SellDetails extends Model
{
	/*
    |------------------------------
    | Relación con el modelo Stock.
    |------------------------------
    */
	public function stock()
	{
		return $this->belongsTo('App\Stock', 'stock_id');
	}

	/*
    |--------------------------------
    | Relación con el modelo Product.
    |--------------------------------
    */
	public function product()
	{
		return $this->belongsTo('App\Product');
	}

	/*
    |---------------------------------
    | Relación con el modelo Customer.
    |---------------------------------
    */
	public function customer()
	{
		return $this->belongsTo('App\Customer');
	}

	/*
    |-----------------------------------------------------------------------
    | Relación con el modelo User.
	| Si no hay un usuario asociado, se establece un usuario predeterminado.
    |-----------------------------------------------------------------------
    */
	public function user()
	{
		return $this->belongsTo('App\User')->withDefault([
			'id' => 0,
			'name' => 'Unknown User'
		]);
	}
}
