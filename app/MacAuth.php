<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MacAuth extends Model
{
    protected $table = "MacAuth";
    protected $fillable = array('MacAddress', 'Holder', 'model', 'Expire','GroupName','Create_by');

    private $rules = array(
            'MacAddress' => 'required',
            'Holder' => 'required'
    );
}
