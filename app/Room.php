<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "Rooms";
    protected $fillable = array('id', 'Room', 'RoomType', 'GroupName','created_by','update_by');

    private $rules = array(
            'Room' => 'required',
            'GroupName' => 'required'
    );
}
