<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\MessageRoom;
use App\Models\MessageUser;
use App\Models\MessageRead;
use App\Models\ActivityImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Payjp\Charge;

class ItemsController extends Controller
{
    public function showItems(Request $request)
    {
        // クエリビルダを取得する
        $query = Item::query();

        //①エリアで絞り込み
        if ($request->filled('prefecture')) {
            $query->where('prefecture_id', $request->input('prefecture'));
        }

        // ②カテゴリで絞り込み
        if ($request->filled('category')) {

            //カテゴリから種別とIDを切り出す
            list($categoryType, $categoryID) = explode(':', $request->input('category'));

            //プライマリーカテゴリで絞り込み
            if ($categoryType === 'primary') {

                //whereHasでリレーション先のテーブルのカラムを基に絞り込む
                //第一引数:リレーションを定義しているメソッドの名前を指定
                //第二引数:無名関数（クロージャ）を指定
                $query->whereHas('secondaryCategory', function ($query) use ($categoryID) {
                    $query->where('primary_category_id', $categoryID);
                });

            //セカンダリーカテゴリで絞り込み
            } else if ($categoryType === 'secondary') {
                $query->where('secondary_category_id', $categoryID);
            }
        }

        // ③キーワードで絞り込み
        if ($request->filled('keyword')) {

            //%で部分一致検索に指定、特殊記号をエスケープ
            $keyword = '%' . $this->escape($request->input('keyword')) . '%';

            // A AND (B OR C)条件
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', $keyword);
                $query->orWhere('description', 'LIKE', $keyword);
            });
        }

        //商品状態を出品中・購入済みの順で表示
        $items = $query->orderByRaw( "FIELD(state, '" . Item::STATE_SELLING . "', '" . Item::STATE_BOUGHT . "')" )

            // ネストしたリレーションメソッドを使用する時はドット記法でつなぐ
            ->with('secondaryCategory.primaryCategory', 'likes', 'prefecture')
            ->orderBy('id', 'DESC')

            // ページング処理
            ->paginate(8);

        return view('items.items')
            ->with('items', $items);
    }

    private function escape(string $value)
    {
        //LIKE句で使用できる特殊記号を置換して無効化（エスケープ）
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }

    public function showItemDetail(Item $item)
    {
        return view('items.item_detail')
            ->with('item', $item);
    }

    public function showBuyItemForm(Item $item)
    {
        // エラーテンプレートはresources/views/errors以下に存在
        if (!$item->isStateSelling) {
            abort(404);
        }

        return view('items.item_buy_form')
            ->with('item', $item);
    }

    public function buyItem(Request $request, Item $item)
     {
         $user = Auth::user();

         if (!$item->isStateSelling) {
             abort(404);
         }

         $token = $request->input('card-token');

         try {
             $this->settlement($item->id, $item->seller->id, $user->id, $token);

         } catch (\Exception $e) {

            // デフォルトでは、ログはstorage/logs/laravel.logに記録
            // アプリケーションで例外をキャッチしなかった場合、Laravelによってキャッチされ、ログに記録された後、以下のエラー画面が表示

             Log::error($e);
             return redirect()->back()
                 ->with('type', 'danger')
                 ->with('message', '購入処理が失敗しました。');
         }

         return redirect()->route('item', [$item->id])
             ->with('message', '商品を購入しました。');
     }

     private function settlement($itemID, $sellerID, $buyerID, $token)
     {
        //  トランザクションとロールバックでエラー時の不整合を防ぐ
         DB::beginTransaction();

         try {
            //①DB側への登録と重複確認
            // 単一レコードをfindで取得して排他ロックして多重決済を回避
             $seller = User::lockForUpdate()->find($sellerID);
             $item   = Item::lockForUpdate()->find($itemID);

             if ($item->isStateBought) {
                 throw new \Exception('多重決済');
             }

             $item->state     = Item::STATE_BOUGHT;
             $item->bought_at = Carbon::now();
             $item->buyer_id  = $buyerID;

            //未読設定
            $seller_messageread = MessageRead::create([
                'read' => false,
            ]);

            $buyer_messageread = MessageRead::create([
                'read' => false,
            ]);

            $item->seller_read_id = $seller_messageread->id;
            $item->buyer_read_id = $buyer_messageread->id;

            //メッセージルームを作成
             $messageroom = MessageRoom::create([]);
             $item->message_room_id = $messageroom->id;
             $item->save();

             $seller->sales += $item->price;
             $seller->save();

            //メッセージユーザーに登録
             $buy_messageuser = MessageUser::create([
                'message_user_id' => $buyerID,
                'message_room_id' => $messageroom->id
             ]);

             $sold_messageuser = MessageUser::create([
                'message_user_id' => $sellerID,
                'message_room_id' => $messageroom->id
             ]);

            // ②PAY.JP側への決済処理を実行
            //戻り値はChargeクラスのインスタンス。
             $charge = Charge::create([
                'card'     => $token,
                'amount'   => $item->price,
                'currency' => 'jpy'
            ]);
            if (!$charge->captured) {
                throw new \Exception('支払い確定失敗');
            }

         } catch (\Exception $e) {
             DB::rollBack();
             throw $e;
         }

         DB::commit();
     }

    // いいねをつける
     public function like(Request $request, Item $item)
    {
        $item->likes()->detach($request->user()->id);
        $item->likes()->attach($request->user()->id);

        return [
            'id' => $item->id,
            'countLikes' => $item->likes_count,
        ];
    }

    // いいねを外す
    public function unlike(Request $request, Item $item)
    {
        $item->likes()->detach($request->user()->id);

        return [
            'id' => $item->id,
            'countLikes' => $item->likes_count,
        ];
    }

    //出品者詳細表示
    public function showSeller(User $user)
    {
        return view('seller')
        ->with([
            'user' => $user,
        ]);
    }
}
