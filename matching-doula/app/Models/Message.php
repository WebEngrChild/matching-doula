<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// リアルタイムチャット機能（使わなかったら削除）
class Message extends Model
{
    protected $fillable = ['message'];

    public function messageUser()
    {
        return $this->belongsTo(User::class);
    }
}
