<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WifiGroup extends Model
{
    protected $table = "WifiGroup";
    protected $fillable = array('GroupName', 'MaxConcurrent', 'Upload', 'Download','Redirect','Description','Status');

    private $rules = array(
            'GroupName' => 'required|unique',
            'MaxConcurrent' => 'required'
    );
}
