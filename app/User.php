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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ADMIN_TYPE = 0;
    const USER_TYPE = 1;
    const DEFAULT_TYPE = 2;
    public function isAdmin(){
        return $this->type === self::ADMIN_TYPE;
    }
    public function isUser(){
        return $this->type === self::USER_TYPE;
    }
    public function isDisableUser(){
        return $this->type === self::DEFAULT_TYPE;
    }
}
