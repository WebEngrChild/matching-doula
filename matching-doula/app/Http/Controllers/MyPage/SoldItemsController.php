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
        ->with('secondaryCategory.primaryCategory' ,'sellerRead') // 変更
        ->orderBy('id', 'DESC')
        ->get();


        //通知機能
        // $message_room_id = $user->messagesUsers
        // ->where('message_user_id', $user->id)
        // ->where('read', false);

        return view('mypage.sold_items')
            ->with([
                "items" => $items,
                // "rooms" => $message_room_id,
            ]);
    }
}


