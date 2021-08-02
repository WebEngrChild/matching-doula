<?php

namespace App\Http\Controllers\MyPage;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Message; //追加
use App\Models\Item; //追加
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('mypage.post');
    }

    public function fetchMessages()
    {
        return Message::with('users')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        // $message = $user->messages()->where('message')->create([
        //     'message' => $request->input('message')
        // ]);
        $message = $user
        ->messages()
        // ->where('messages_room_id', '=', $user->messageRooms )
        ->create([
            'message' => $request->input('message')
        ]);

        event(new MessageSent($user, $message));

        return ['status' => 'Message Sent!'];
    }
}
