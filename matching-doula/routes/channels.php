<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MessageUser;// リアルタイムチャット機能

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// // リアルタイムチャット機能
// Broadcast::channel('chat', function ($user) {
//     return Auth::check();
// });

Broadcast::channel('chat.{messageRoomId}', function ($message_room_id) {

    $user = Auth::user();
    $meesagerooms = $user->messageRooms()->get();

    // return Auth::check();

    if(Auth::check()) {
     foreach ($meesagerooms as $meesageroom)
        if( $meesageroom->id === $message_room_id ) {
            return true;
            break;
        }
        return true;
      }
    }
    // $message_room = Auth::->where('message_user_id', $user->id);
    // $authenticated_user = MessageUser::where('message_room_id', $messageRoomId)->first();
    // return Auth::check() and $user_id === $authenticated_user->message_user_id;
    // return $user->messageRooms->id === $message_room_id;
    // );
);
