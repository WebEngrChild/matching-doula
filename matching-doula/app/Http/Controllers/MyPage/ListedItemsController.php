<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// class SoldItemsController extends Controller
// {
//     public function showSoldItems()
//     {
//         $user = Auth::user();

//         $items = $user->soldItems()->orderBy('id', 'DESC')->get();

//         return view('mypage.sold_items')
//             ->with('items', $items);
//     }
// }

class ListedItemsController extends Controller
{
    public function showListedItems()
    {
        $user = Auth::user();

        /*
        * ネストしたリレーションメソッドを使用する時はドット記法でつなぐ
        * ドットの前で記述したリレーションメソッドも動的プロパティーとして持つことができる
        */
        $items = $user->soldItems()
            ->with('secondaryCategory.primaryCategory') // 変更
            ->orderBy('id', 'DESC')
            ->get();

            return view('mypage.listed_items')
                    ->with('items', $items);
    }
}

