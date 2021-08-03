<?php

namespace App\Http\Controllers\MyPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Message; //追加
use App\Models\Item; //追加
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
        $item = $messageroom->messageItem->find($messageroom->id);
        return view('mypage.post')->with('item', $item);
    }

    public function fetchMessages(MessageRoom $messageroom)
    {
        $user = Auth::user();
        return Message::with('messageUser')
        ->where('message_user_id', $user->id)
        ->where('message_room_id', $messageroom->id)->get();
        // return Message::with('messageUser')->get();
    }

    public function sendMessage(Request $request, MessageRoom $messageroom)
    {
        $user = Auth::user();
        // $message = $user->messages()->where('message')->create([
        //     'message' => $request->input('message')
        // ]);
        $message = $user->messages()->create([
            'message' => $request->input('message'),
            'message_room_id' => $messageroom->id,
            'message_user_id' => $user->id
        ]);

        event(new MessageSent($user, $message, $messageroom));

        return ['status' => 'Message Sent!'];
    }
}
