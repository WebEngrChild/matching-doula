<?php

namespace App\Http\Controllers\MyPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MessageRoom;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ZoomMakeController extends Controller
{
    // 文字列をURL-Safe Base64でエンコード
    public static function urlsafe_base64_encode($str)
    {
       return str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($str));
    }

    //ZOOM APIを叩いてMeeting新規作成
     public function makeZoomMeeting(Request $request, MessageRoom $messageroom)
     {
        //JWTトークン作成
        $zoom_url = config('zoom.zoom_adress');
        $zoom_api_key = config('zoom.zoom_id');
        $zoom_api_secret = config('zoom.zoom_secret');
        $expiration = time() + 20;
        $header = self::urlsafe_base64_encode('{"alg":"HS256","typ":"JWT"}');
        $payload = self::urlsafe_base64_encode('{"iss":"' . $zoom_api_key . '","exp":"' . $expiration . '"}');
        $signature = self::urlsafe_base64_encode(hash_hmac('sha256', "$header.$payload", $zoom_api_secret, TRUE));
        $token = "$header.$payload.$signature";

        //フォーム内容でリクエスト用コンテンツデータ作成
        $data_to_zoom_api = array(
            "topic" => "マッチングドゥーラの寄り添い",
            "type" => "2",
            "start_time" => $request->startAt,
            "timezone" => "Asia/Tokyo",
            "password" => "",
            "settings" => array(
                'host_video' => true,
                'participant_video' => true,
                'approval_type' => 0,
                'audio' => 'both',
                'enforce_login' => false,
                'waiting_room' => false,
                'join_before_host' => true,
                'registrants_confirmation_email' => true,
            )
            );

        //リクエストデータ作成
        $options = array(
            'http' => array(
            'method'=> 'POST',
            'header'=> array(
                'Content-type: application/json',
                'Authorization: Bearer' . $token,
            ),
            'content' => json_encode($data_to_zoom_api)
            )
        );

        $context = stream_context_create($options);
        $json_result = file_get_contents($zoom_url, false, $context);
        $json_result = json_decode($json_result, true);
        $join_url = $json_result['join_url'];
        $password = $json_result['password'];
        $meeting_id = $json_result['id'];

        $join_url = substr($join_url, 0, strcspn($join_url,'?'));

        //個人チャットにURL送信
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $join_url,
            'message_room_id' => $messageroom->id,
            'message_user_id' => $user->id
        ]);
        event(new MessageSent($user, $message, $messageroom));

        //個人チャットにパスワード送信
        $message = $user->messages()->create([
            'message' => $password,
            'message_room_id' => $messageroom->id,
            'message_user_id' => $user->id
        ]);

        event(new MessageSent($user, $message, $messageroom));

        //  チャットルームを表示
        $item = $messageroom->messageItem->first();

        return redirect()->route('mypage.messageroom-index', [$messageroom->id]);
    }
}



