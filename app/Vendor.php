<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
|----------------------------------------------------------------
| Representa el modelo de la tabla 'vendors' de la base de datos.
|----------------------------------------------------------------
*/

class Vendor extends Model
{
    /*
    |------------------------------
    | Relación con el modelo Stock.
    |------------------------------
    */
    public function stock()
    {
        return $this->hasMany('App\Stock');
    }
}
