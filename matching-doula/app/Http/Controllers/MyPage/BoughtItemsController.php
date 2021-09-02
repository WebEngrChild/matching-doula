<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoughtItemsController extends Controller
{
    public function showBoughtItems()
    {
        //ログイン情報取得
        $user = Auth::user();

        //商品カテゴリーと既読有無を合わせて取得
        $items = $user->boughtItems()
        ->with('secondaryCategory.primaryCategory', 'buyerRead')
        ->orderBy('id', 'DESC')
        ->get();

        return view('mypage.bought_items')
        ->with([
            "items" => $items,
        ]);
    }
}
