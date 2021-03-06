<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Item;
use App\Models\MessageRead;
use App\Models\MessageUser;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Models\MessageRoom;

class MessageRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(MessageRoom $messageroom)
    {
        //ログイン情報取得
        $user = Auth::User();
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
        $item = $messageroom->messageItem->where('message_room_id', $messageroom->id)->first();

        return view('mypage.message_room')
        ->with([
            'item' => $item,
            'user' => $user,
        ]);
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

        //自分を既読にする(自身のユーザーIDを売り手・買い手の条件に合わせて判断)
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

        //messageroomのidに紐づくMessageをcollectionで返す（Vue.js側で使用）
        return Message::with('messageUser')
        ->where('message_room_id', $messageroom->id)->get();
    }

    public function sendMessage(Request $request, MessageRoom $messageroom)
    {
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

        //相手を既読にする(自身のユーザーIDをもとに相手の条件（買い手・売り手）に合わせて判断)
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

        //メッセージ送信イベントを発生
        event(new MessageSent($user, $message, $messageroom));

        return ['status' => 'Message Sent!'];
    }
}
