<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth; //追加

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // 出品中
    const STATE_SELLING = 'selling';
    // 購入済み
    const STATE_BOUGHT = 'bought';

    //商品の購入日時をCarbonクラスとして取得
    //キー名にカラム名を、値に変換先のデータ型を指定
    //bought_atカラムを取り出す際にdatetime(Carbonクラス)に変換するように設定しています。
//  デフォルトのcreated_at,updated_atは記載不要
    protected $casts = [
    'bought_at' => 'datetime',
];

    public function secondaryCategory()
    {
        return $this->belongsTo(SecondaryCategory::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function condition()
    {
        return $this->belongsTo(ItemCondition::class, 'item_condition_id');
    }

    public function getIsStateSellingAttribute()
    {
        return $this->state === self::STATE_SELLING;
    }

    public function getIsStateBoughtAttribute()
    {
        return $this->state === self::STATE_BOUGHT;
    }

    // いいね機能
    //多数対多数のリレーション
    public function likes()
    {
        return $this->belongsToMany('App\Models\User', 'likes')->withTimestamps();
    }

    /**
     * アクセサ - likes_count
     * @return integer
     */
    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }

    /**
     * そのコメントにログインユーザー（プロフィール）がすでにいいねをおしているかチェック
     * アクセサ - liked_by_user
     * @return boolean
     */
    public function getLikedByUserAttribute()
    {
        if (Auth::guest()) {
            return false;
        }

        return $this->likes->contains(function ($user) {

            return $user->id === Auth::user()->id;
        });
    }

    // リアルタイムチャット機能
    public function messageRoom()
    {
        return $this->hasOne(MessageRoom::class);
    }
}
