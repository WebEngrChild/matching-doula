<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageRead extends Model
{
    protected $fillable = ['read'];

    public function soldMessageItem()
    {
        return $this->hasMany(Item::class, 'seller_read_id');
    }

    public function boughtMessageItem()
    {
        return $this->hasMany(Item::class, 'buyer_read_id');
    }
}
