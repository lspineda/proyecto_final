<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
|-------------------------------------------------------------------
| Representa el modelo de la tabla 'categories' de la base de datos.
|-------------------------------------------------------------------
*/

class Category extends Model
{
    /*
    |--------------------------------
    | Relación con el modelo Product.
    |--------------------------------
    */
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
