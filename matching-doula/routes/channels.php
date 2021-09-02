<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MessageUser;

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

Broadcast::channel('chat.{messageRoomId}', function ($message_room_id) {

    $user = Auth::user();
    $meesagerooms = $user->messageRooms()->get();

    if(Auth::check()) {
     foreach ($meesagerooms as $meesageroom)
        if( $meesageroom->id === $message_room_id ) {
            return true;
            break;
        }
        return true;
      }
    }
);
