<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
|--------------------------------------------------------------
| Representa el modelo de la tabla 'stock' de la base de datos.
|--------------------------------------------------------------
*/

class Stock extends Model
{
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
    | Relación con el modelo Category.
    |---------------------------------
    */
    public function category()
    {
        return $this->belongsTo('App\Category');
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

    /*
    |-------------------------------
    | Relación con el modelo Vendor.
    |-------------------------------
    */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

    /*
    |------------------------------------
    | Relación con el modelo SellDetails.
    |------------------------------------
    */
    public function sell_details()
    {
        return $this->hasMany('App\SellDetails', 'stock_id');
    }
}
