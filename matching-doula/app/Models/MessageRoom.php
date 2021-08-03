<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageRoom extends Model
{
    //リアルタイムチャット
    public function messages()
    {
        return $this->hasMany(Message::class, 'message_room_id');
    }

    // リアルタイムチャット機能
    public function messageItem()
    {
        return $this->hasOne(Item::class, 'message_room_id');
    }

    // リアルタイムチャット機能
    public function messageUsers()
    {
        return $this->belongsToMany(User::class, 'message_users', 'message_room_id', 'message_user_id', 'id');
    }
}
