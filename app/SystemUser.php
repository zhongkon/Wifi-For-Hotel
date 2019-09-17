<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemUser extends Model
{
    protected $table = "users";
    protected $fillable = [
        'name', 'email', 'password',
    ];

    private $rules = array(
            'email' => 'required',
            'name' => 'required'
    );
}
