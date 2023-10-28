<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/*
|--------------------------------------------------------------
| Representa el modelo de la tabla 'users' de la base de datos.
|--------------------------------------------------------------
*/

class User extends Authenticatable
{
    use Notifiable;

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
    |-----------------------------
    | Relación con el modelo Sell.
    |-----------------------------
    */
    public function Sell()
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

    /*
    |--------------------------------
    | Relación con el modelo Payment.
    |--------------------------------
    */
    public function payment()
    {
        return $this->hasMany('App\Payment');
    }

    /*
    |-----------------------------------------------------------------------------------
    | Relación con el modelo Role.
    | Un usuario pertenece a un rol específico.
    | Si no tiene un rol específico, se establece el rol predeterminado como 'Invitado'.
    |-----------------------------------------------------------------------------------
    */
    public function role()
    {
        return $this->belongsTo('App\Role')->withDefault([
            'id' => 0,
            'role_name' => 'Invitado',
        ]);
    }

    /*
    |--------------------------------------
    | Atributos que son asignables en masa.
    |--------------------------------------
    */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /*
    |---------------------------------------------------
    | Atributos que deben ser ocultados para los arrays.
    |---------------------------------------------------
    */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
