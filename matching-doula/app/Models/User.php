<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function soldItems()
    {
        return $this->hasMany(Item::class, 'seller_id');
    }

    public function boughtItems()
    {
        return $this->hasMany(Item::class, 'buyer_id');
    }

    // いいね機能
    //多数対多数のリレーション
    public function likes()
    {
        return $this->belongsToMany(Item::class, 'likes')->withTimestamps();
    }

    //自分についたいいね
    public function myLikes()
    {
        return $this->hasManyThrough(Like::class, Item::class, 'seller_id', 'item_id');
    }

    //リアルタイムチャット(チャットのやりとり)
    public function messages()
    {
        return $this->hasMany(Message::class, 'message_user_id');
    }

    //リアルタイムチャット（認証につかう）
    public function messageRooms()
    {
        return $this->belongsToMany(MessageRoom::class, 'message_users', 'message_user_id')->withTimestamps();
    }

    public function messagesUsers()
    {
        return $this->hasMany(MessageUser::class, 'message_user_id');
    }

    //通知機能
    public function sellerRead()
    {
        return $this->belongsToMany(MessageRead::class, 'items', 'seller_id', 'seller_read_id')->withTimestamps();
    }

    public function buyerRead()
    {
        return $this->belongsToMany(MessageRead::class, 'items', 'buyer_id', 'buyer_read_id')->withTimestamps();
    }
}
