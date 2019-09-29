<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ipbinding extends Model
{
    protected $table = "Ipbindings";
    protected $fillable = array('MacAddress', 'Holder', 'model','info','Create_by');

}
