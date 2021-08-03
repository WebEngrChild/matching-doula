<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// リアルタイムチャット機能（使わなかったら削除）
class Message extends Model
{
    protected $fillable = ['message', 'message_user_id', 'message_room_id'];

    public function messageUser()
    {
        return $this->belongsTo(User::class);
    }

    public function messageRoom()
    {
        return $this->belongsTo(MessageRoom::class);
    }
}
