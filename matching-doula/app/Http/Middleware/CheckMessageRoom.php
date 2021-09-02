<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MessageRoom;
use Illuminate\Http\Request;

use Closure;

class CheckMessageRoom
{
    const MESSAGEROOM = 'messagesroom';
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
        //リクエストされたURIからmesseageroomのidのみを抽出する
        $messageroomid = (int) str_replace(self::MESSAGEROOM, "",strstr(str_replace(self::SLASHSIGN, "", $request->getRequestUri()),self::MESSAGEROOM));

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
