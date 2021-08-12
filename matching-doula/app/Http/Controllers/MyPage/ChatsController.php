<?php

namespace App\Http\Controllers\MyPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Message; //追加
use App\Models\Item; //追加
use App\Models\MessageRead; //通知機能
use App\Models\MessageUser; //通知機能
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

use App\Models\MessageRoom;// リアルタイムチャット機能

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(MessageRoom $messageroom)
    {
        $user = Auth::User();

        //通知機能（自分を既読にする）
        //ログインしたユーザー情報を取得
        $user_id = Auth::id();

        //今回の取引商品の情報を取得
        $item = $messageroom->messageItem;

        //売り手と買い手のユーザーIDを取得
        $seller_id = $item->seller->id;
        $buyer_id = $item->buyer->id;

        //売り手の買い手のreadモデルを取得
        $seller_read = $item->sellerRead;
        $buyer_read = $item->buyerRead;

        //自分を既読にする
        switch ($user_id){
            case $seller_id:
                $seller_read->read = 1;
                $seller_read->save();

            break;
            case $buyer_id:
                $buyer_read->read = 1;
                $buyer_read->save();
            break;
            default:
            return redirect()->route('mypage.bought-items');
            }

        //リアルタイムチャット機能
        $item = $messageroom->messageItem->find($messageroom->id);
        return view('mypage.post')->with('item', $item);
    }

    public function fetchMessages(MessageRoom $messageroom)
    {
        //通知機能（自分を既読にする）
        //ログインしたユーザー情報を取得
        $user_id = Auth::id();

        //今回の取引商品の情報を取得
        $item = $messageroom->messageItem;

        //売り手と買い手のユーザーIDを取得
        $seller_id = $item->seller->id;
        $buyer_id = $item->buyer->id;

        //売り手の買い手のreadモデルを取得
        $seller_read = $item->sellerRead;
        $buyer_read = $item->buyerRead;

        //自分を既読にする
        switch ($user_id){
            case $seller_id:
                $seller_read->read = 1;
                $seller_read->save();

            break;
            case $buyer_id:
                $buyer_read->read = 1;
                $buyer_read->save();
            break;
            default:
            return redirect()->route('mypage.bought-items');
            }

        $user = Auth::user();

        return Message::with('messageUser')
        ->where('message_room_id', $messageroom->id)->get();
    }

    public function sendMessage(Request $request, MessageRoom $messageroom)
    {
        //通知機能（相手を未読にする）
        //ログインしたユーザー情報を取得
        $user_id = Auth::id();

        //今回の取引商品の情報を取得
        $item = $messageroom->messageItem;

        //売り手と買い手のユーザーIDを取得
        $seller_id = $item->seller->id;
        $buyer_id = $item->buyer->id;

        //売り手の買い手のreadモデルを取得
        $seller_read = $item->sellerRead;
        $buyer_read = $item->buyerRead;

        //相手を既読にする
        switch ($user_id){
            case $seller_id:
                $buyer_read->read = 0;
                $buyer_read->save();

            break;
            case $buyer_id:
                $seller_read->read = 0;
                $seller_read->save();
            break;
            default:
            return redirect()->route('mypage.bought-items');
            }

        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $request->input('message'),
            'message_room_id' => $messageroom->id,
            'message_user_id' => $user->id
        ]);

        event(new MessageSent($user, $message, $messageroom));

        return ['status' => 'Message Sent!'];
    }
}
