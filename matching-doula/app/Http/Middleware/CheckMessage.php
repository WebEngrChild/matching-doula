<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MessageRoom;
use Illuminate\Http\Request;

use Closure;

class CheckMessage
{
    const MESSAGEROOM = 'messagesroom';
    const MESSAGE = 'messages';
    const SLASHSIGN = '/';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $messageroom_messages = self::MESSAGEROOM . self::MESSAGE;

        //リクエストされたURIからmesseageroomのidのみを抽出する
        $messageroomid = (int) str_replace($messageroom_messages, "",strstr(str_replace(self::SLASHSIGN, "", $request->getRequestUri()),self::MESSAGE));

        if(Auth::check()){
            $user = Auth::user();
            $meesagerooms = $user->messageRooms()->get();
            $check = false;

            if($meesagerooms->isEmpty()) {
                return redirect()->route('top');
            };

            foreach ($meesagerooms as $meesageroom) {
            if($meesageroom->id === $messageroomid ) {
                $check = true;
                break;
            };
          };

            if($check<>true) {
              return redirect()->route('top');
          };
        };
         return $next($request);
    }
}
