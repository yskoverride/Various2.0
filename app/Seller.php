<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Class which implements Illuminate\Contracts\Auth\Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable
{
    //Mass assignable attributes
    protected $fillable = [
      'name', 'email', 'password',
    ];

    //hidden attributes
    protected $hidden = [
       'password', 'remember_token',
    ];
}
