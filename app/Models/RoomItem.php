<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomItem extends Model
{
            protected $fillable = ['room_id',
            'price',
            'type',
            'user_id',
            'date_start',
            'date_end',
            'status'];

            public function documents() {
            	return [];
            }

            public function roomName() {
                  return '('.Room::find($this->room_id)->number.')';
            }
}
