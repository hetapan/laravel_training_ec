<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login_id',
        'password',
        'name',
        'name_kana',
        'birth_year',
        'birth_month',
        'birth_day',
        'gender',
        'mail',
        'tel1',
        'tel2',
        'tel3',
        'postal_code1',
        'postal_code2',
        'pref',
        'city',
        'address',
        'other',
        'memo',
        'status'
    ];
}
