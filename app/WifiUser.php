<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WifiUser extends Model
{
    protected $table = "wifiuser";
    protected $fillable = array('functionname', 'username', 'password', 'wifigroup','qty','comment','functiondate','functionend','createby');

    private $rules = array(
            'functionname' => 'required',
            'usernameinput' => 'required'
    );
}
