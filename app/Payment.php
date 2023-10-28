<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
|-----------------------------------------------------------------
| Representa el modelo de la tabla 'payments' de la base de datos.
|-----------------------------------------------------------------
*/

class Payment extends Model
{
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
