<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'item_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
 }
