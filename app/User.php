<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password'];
    use HasApiTokens, Notifiable;

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
}