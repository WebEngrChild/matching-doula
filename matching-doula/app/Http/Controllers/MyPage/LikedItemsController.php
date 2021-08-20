<?php

namespace App\Http\Controllers\MyPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LikedItemsController extends Controller
{
    public function showLikedItems()
    {
        $user = Auth::user();

        /*
        * ネストしたリレーションメソッドを使用する時はドット記法でつなぐ
        * ドットの前で記述したリレーションメソッドも動的プロパティーとして持つことができる
        */
        $items = $user->likes()
            ->with('secondaryCategory.primaryCategory') // 変更
            ->orderBy('id', 'DESC')
            ->get();

            return view('mypage.liked_items')
                    ->with('items', $items);
    }

    public function showLikedUsers()
    {
        $users= User::withCount('myLikes')
        ->orderBy('my_likes_count','desc')
        ->take(10)
        ->get();


        return view('mypage.liked_users')
        ->with('users', $users);
    }
}

