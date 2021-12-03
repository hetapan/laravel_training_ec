<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin_user extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'login_id', 'password', 'name'
    ];

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
}
