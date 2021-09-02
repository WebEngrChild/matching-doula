<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoldItemsController extends Controller
{
    public function showSoldItems()
    {
        $user = Auth::user();

        /*
        * ネストしたリレーションメソッドを使用する時はドット記法でつなぐ
        * ドットの前で記述したリレーションメソッドも動的プロパティーとして持つことができる
        */
        $items = $user->soldItems()->where('state', 'bought')
        ->with('secondaryCategory.primaryCategory' ,'sellerRead') 
        ->orderBy('id', 'DESC')
        ->get();

        return view('mypage.sold_items')
            ->with([
                "items" => $items,
            ]);
    }
}


