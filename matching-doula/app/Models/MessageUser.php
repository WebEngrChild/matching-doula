<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageUser extends Model
{
    protected $fillable = ['message_user_id', 'message_room_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messageRoom()
    {
        return $this->belongsTo(MessageRoom::class);
    }
}
