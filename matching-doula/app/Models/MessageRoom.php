<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageRoom extends Model
{
//リアルタイムチャット
    public function messages()
    {
        return $this->hasMany(Message::class, 'message_room_id')->withTimestamps();
    }
}
