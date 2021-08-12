<?php

namespace App\Http\Controllers\MyPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class LikedItemsController extends Controller
{
    public function showLikedItems()
    {
        $user = Auth::user();
        
        $items = $user->likes()
            ->with('secondaryCategory.primaryCategory') // 変更
            ->orderBy('id', 'DESC')
            ->get();

            return view('mypage.liked_items')
                    ->with('items', $items);
    }
}

