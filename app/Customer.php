<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
|------------------------------------------------------------------
| Representa el modelo de la tabla 'customers' de la base de datos.
|------------------------------------------------------------------
*/

class Customer extends Model
{
	/*
    |-----------------------------
    | Relación con el modelo Sell.
    |-----------------------------
    */
	public function sell()
	{
		return $this->hasMany('App\Sell');
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
