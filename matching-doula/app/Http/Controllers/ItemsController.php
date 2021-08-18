<?php

namespace App\Http\Controllers;


use App\Models\Item;
use App\Models\User;// 商品購入に使う
use App\Models\MessageRoom;// リアルタイムチャット機能
use App\Models\MessageUser;// リアルタイムチャット機能
use App\Models\MessageRead;// 通知機能
use Carbon\Carbon;// 商品購入に使う
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;// 商品購入に使う
use Illuminate\Support\Facades\DB;// 商品購入に使う
use Illuminate\Support\Facades\Log;// 商品購入に使う
use Payjp\Charge;//決済処理に使う

class ItemsController extends Controller
{
    public function showItems(Request $request)
    {
        $query = Item::query();// クエリビルダを取得する

        //エリアで絞り込み
        if ($request->filled('prefecture')) {
            $query->where('prefecture_id', $request->input('prefecture'));
        }

        // カテゴリで絞り込み
        if ($request->filled('category')) {
            list($categoryType, $categoryID) = explode(':', $request->input('category'));

            if ($categoryType === 'primary') {
                $query->whereHas('secondaryCategory', function ($query) use ($categoryID) {
                    $query->where('primary_category_id', $categoryID);
                });
            } else if ($categoryType === 'secondary') {
                $query->where('secondary_category_id', $categoryID);
            }
        }

        // キーワードで絞り込み
        if ($request->filled('keyword')) {
            $keyword = '%' . $this->escape($request->input('keyword')) . '%';

        // A AND (B OR C)条件
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', $keyword);
                $query->orWhere('description', 'LIKE', $keyword);
            });
        }

        $items = $query->orderByRaw( "FIELD(state, '" . Item::STATE_SELLING . "', '" . Item::STATE_BOUGHT . "')" )
            /*
            * ネストしたリレーションメソッドを使用する時はドット記法でつなぐ
            * ドットの前で記述したリレーションメソッドも動的プロパティーとして持つことができる
            */

            // いいね実装時に修正
            ->with('secondaryCategory.primaryCategory', 'likes', 'prefecture') // 変更箇所
            ->orderBy('id', 'DESC')

            // ページング処理
            ->paginate(10);

            // dd($items);

        return view('items.items')
            ->with('items', $items);
    }

    private function escape(string $value)
    {
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
        // エラーページをカスタマイズしたい場合は、以下のコマンドを実行して生成されたテンプレートを編集します。
        // テンプレートはresources/views/errors以下に生成されます。
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
             // $item->seller->idはuserのID取得
             //$item->seller_idでもOK。同じことをしている。

         } catch (\Exception $e) {

            // デフォルトでは、ログはstorage/logs/laravel.logに記録されます。
            // なお、アプリケーションで例外をキャッチしなかった場合、Laravelによってキャッチされ、ログに記録された後、以下のエラー画面が表示されます。

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
            // 単一レコードをfindで取得して排他ロックして多重決済を避ける
             $seller = User::lockForUpdate()->find($sellerID);//$item->seller->id  商品起点で紐づく売った人を取得。ユーザーテーブルで検索しているのでユーザーテーブルのID
             $item   = Item::lockForUpdate()->find($itemID);

             if ($item->isStateBought) {
                 throw new \Exception('多重決済');
             }

             $item->state     = Item::STATE_BOUGHT;
             $item->bought_at = Carbon::now();
             $item->buyer_id  = $buyerID;//$user->id  ログインしている人

            //  ===========通知機能=================
            $seller_messageread = MessageRead::create([
                'read' => false,
            ]);

            $buyer_messageread = MessageRead::create([
                'read' => false,
            ]);

            $item->seller_read_id = $seller_messageread->id;
            $item->buyer_read_id = $buyer_messageread->id;

            //  ===========リアルタイムチャット機能(1)=================
             $messageroom = MessageRoom::create([]);
             $item->message_room_id = $messageroom->id;
             $item->save();

             $seller->sales += $item->price;
             $seller->save();

            //  ===========リアルタイムチャット機能(2)=================
             $buy_messageuser = MessageUser::create([
                'message_user_id' => $buyerID,
                'message_room_id' => $messageroom->id
             ]);

             $sold_messageuser = MessageUser::create([
                'message_user_id' => $sellerID,
                'message_room_id' => $messageroom->id
             ]);

            // ②PAY.JP側への決済処理を実行する
            //戻り値はChargeクラスのインスタンスです。
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
    public function showSeller(Item $item)
    {
        $seller = $item->seller->first();

        return view('items.item_seller')
        ->with('user', $seller);
    }
}
