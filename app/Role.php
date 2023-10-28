<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
|--------------------------------------------------------------
| Representa el modelo de la tabla 'roles' de la base de datos.
|--------------------------------------------------------------
*/

class Role extends Model
{
    /*
    |-----------------------------
    | Relación con el modelo User.
    |-----------------------------
    */
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
