<?php
use App\Models\Item;

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Item::class)->create([
            'id'      => 1,
            'seller_id'    => 1,
            'buyer_id' => null,
            'secondary_category_id' => 1,
            'item_condition_id' => 2,
            'name' => 'マタニティ用コート',
            'image_file_name' => 'MTOf8QPRPBC22JsUFTd2zGkTSHH8dsKxAplt2ZV3.jpg',
            'description' => '冬の寒い時期に赤ちゃんも一緒にだっこできるダウンコートになります。かなり温かいのでおすすめです。サイズはMサイズです。私の身長は153cmで少し大きめのサイズです。ブランドは『happyマタニティー』になります。',
            'price' => '10000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'zoom' => 'なし',
            'postage' => 'あり',
            'message_room_id' => null,
            'prefecture_id' => 1,
            'seller_read_id' => null,
            'buyer_read_id' => null,
        ]);
        factory(Item::class)->create([
            'id'      => 2,
            'seller_id'    => 1,
            'buyer_id' => null,
            'secondary_category_id' => 2,
            'item_condition_id' => 1,
            'name' => '産後用あったかのびのびパンツ',
            'image_file_name' => 'c8BoisE5Ah6pnCWB6qWFRNb9XunAyVZqrgbhBBWF.jpg',
            'description' => '産後用ママにおすすめのマタニティパンツになります。友人からもらったままクローゼットにしまったままなので状態としてはかなり良いものだと思います。足からくる下半身の冷えは体調不良の原因にもなるのでなるべく温かくしておくのがおすすめです（経験者より）',
            'price' => '10000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'zoom' => 'なし',
            'postage' => 'あり',
            'message_room_id' => null,
            'prefecture_id' => 2,
            'seller_read_id' => null,
            'buyer_read_id' => null,
        ]);
        factory(Item::class)->create([
            'id'      => 3,
            'seller_id'    => 2,
            'buyer_id' => null,
            'secondary_category_id' => 3,
            'item_condition_id' => 3,
            'name' => 'オーガニックコットンニット',
            'image_file_name' => 'Zftfu7R0w97IvzfyrYm4WNUkQvyg9mTpCt5X33IA.jpg',
            'description' => '授乳期にも使えるおしゃれなニットです。肌触りもよく見た目もかなりかわいいのでおすすめです。サイズはSサイズですが少し大きめなのでゆったり着たい方が良いと思います。',
            'price' => '10000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'zoom' => 'なし',
            'postage' => 'あり',
            'message_room_id' => null,
            'prefecture_id' => 3,
            'seller_read_id' => null,
            'buyer_read_id' => null,
        ]);
        factory(Item::class)->create([
            'id'      => 4,
            'seller_id'    => 1,
            'buyer_id' => null,
            'secondary_category_id' => 7,
            'item_condition_id' => 2,
            'name' => 'マタニティパジャマ',
            'image_file_name' => 'MXRKfi4O38qW6vSClGCgsBeUL8stD6wbBtpqaX2E.jpg',
            'description' => 'ママに寄り添う気持ちから生まれたこだわりパジャマ
            産院でも写真映え！ホルマリンフリーでベビーも安心です。1日中パジャマで過ごす事が増える出産前後は、少し気分も沈みがち。そんなママ達の気分を上げてくれる リュクスなマタニティパジャマです。',
            'price' => '10000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'zoom' => 'なし',
            'postage' => 'あり',
            'message_room_id' => null,
            'prefecture_id' => 3,
            'seller_read_id' => null,
            'buyer_read_id' => null,
        ]);
        factory(Item::class)->create([
            'id'      => 5,
            'seller_id'    => 3,
            'buyer_id' => null,
            'secondary_category_id' => 13,
            'item_condition_id' => 3,
            'name' => '3 in1新生児用ベビーカー',
            'image_file_name' => 'gSoVnmQiQ0O4yiXbFFxCqaHJfWSW6BWyxUKmBOJ6.jpg',
            'description' => '【持って軽い】
            重さわずか5.8キロの軽量モデル。CYBEXブランド史上、1か月から使用できるアイテムとして最軽量を誇ります。 軽いため持ち運びやすく、階段の上り下りなど、折りたたんで持ち運ぶときもノンストレス。自動車への積み込みもラクチンです。
            【押して軽い】
            石畳が多いヨーロッパで、押しやすさを追究して生まれたストレートフレーム構造(※)。 ハンドルを押した力がそのままホイールに伝わります。また、ちょうど良いサイズのシングルホイールで、段差もラクに乗り越えることが可能。 小回りがきき軽やかで押しやすい、快適な走行を体感いただけます。
            ※ハンドルとフロントホイールを直線で結び、手元の操作を前輪にダイレクトに伝えて操作性を向上。 また、フレームの可動部をなくし、シートと一体化させてフレーム剛性を高め、スムースなハンドリングを実現する構造。
            【ずっと軽い】
            15kg（生後１か月3歳ごろ）まで使用可能。 両対面時にシート自体を取り替える構造のためフレーム剛性が高く、お子様が成長しても、スムースな走行性をキープ。 ',
            'price' => '30000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'zoom' => 'あり',
            'postage' => 'あり',
            'message_room_id' => null,
            'prefecture_id' => 1,
            'seller_read_id' => null,
            'buyer_read_id' => null,
        ]);
        factory(Item::class)->create([
            'id'      => 6,
            'seller_id'    => 3,
            'buyer_id' => null,
            'secondary_category_id' => 15,
            'item_condition_id' => 1,
            'name' => '【新品】ベビーベッド',
            'image_file_name' => 'Y8pE0J0iQ8FeF4ufGVZ8jQdwKSocxniVj70E8NJm.png',
            'description' => '【出品者より】子供が大きくなってしまったのでお譲りいたします！取扱もしやすくおすすめです。Zoom相談可能です！私は看護師と助産師の資格も保有しているのでベッドの取り扱い方法以外にも色々とアドバイスできると思います(^ ^)

            【対象】：0～36ヶ月向け
            【折畳・水洗い可能】組立不要で簡単に組み立てが出来ます。コンパクトに折畳み可能で、場所を取りません。ご自宅でカバーのお洗濯が可能です。赤ちゃんの肌にも直接触れるものですのでいつでも清潔にします。通気性優れるリネン、赤ちゃんに優しい。
            【静音キャスター】四つのキャスターはどれも静音タイヤ、静かでスムーズ。後輪に付いてるブレーキはベッドの安定性を守ります。ちなみに、360°回転可能でストッパーも付いております。家の中を自由に動かすことができます。
            【メッシュ蚊帳付き】虫、汚れを離れてます。あるいは猫や犬がいるお家族にもおすすめです。 赤ちゃんがグッスリと眠るように。
            【収納バック付き】コンパクトに収納の上、更に収納バック付き、軽くて、自在に持ち運びできます。家族旅行や帰省の時など、どこへ行っても赤ちゃんを快適な環境で眠らせてあげられます。
            【多機能】揺籃に変身可能。大容量な収納かごつき、小物収納便利。キャスターとブレーキ付き、移動便利。6段階高さ調節可能。カバーを外して洗濯可能。',
            'price' => '30000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'zoom' => 'あり',
            'postage' => 'あり',
            'message_room_id' => null,
            'prefecture_id' => 4,
            'seller_read_id' => null,
            'buyer_read_id' => null,
        ]);
        factory(Item::class)->create([
            'id'      => 7,
            'seller_id'    => 3,
            'buyer_id' => null,
            'secondary_category_id' => 19,
            'item_condition_id' => 1,
            'name' => '【30冊】いろいろ絵本詰め合わせ',
            'image_file_name' => 'BlHNDvmrcbVGuAfzsEIkWGkjkyqqm4ApJtIKAzrP.jpg',
            'description' => '0〜１歳までの絵本の詰め合わせになります。寝る前に読み聞かせてあげると安心して寝てくれます。新品で揃えるとかなり高いのでお買い得だと思います。ぜひご購入ください！合計でかなりの量になるので送料は買い手様ご負担でお願いします。',
            'price' => '2000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'zoom' => 'なし',
            'postage' => 'なし',
            'message_room_id' => null,
            'prefecture_id' => 4,
            'seller_read_id' => null,
            'buyer_read_id' => null,
        ]);
        factory(Item::class)->create([
            'id'      => 8,
            'seller_id'    => 3,
            'buyer_id' => null,
            'secondary_category_id' => 20,
            'item_condition_id' => 1,
            'name' => '【美品】くまさん人形',
            'image_file_name' => 'TAPJutJtG0SldqkwGskT2wzaBjYYUWynlPXnTlUk.jpg',
            'description' => 'こども向けのくまさん人形です。出産祝いにいただいてから一回も使わずしまっていたのでお譲りいたします。',
            'price' => '1000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'zoom' => 'なし',
            'postage' => 'あり',
            'message_room_id' => null,
            'prefecture_id' => 4,
            'seller_read_id' => null,
            'buyer_read_id' => null,
        ]);
        factory(Item::class)->create([
            'id'      => 9,
            'seller_id'    => 2,
            'buyer_id' => null,
            'secondary_category_id' => 23,
            'item_condition_id' => 1,
            'name' => '【実演します】お子さんの離乳食一緒につくりませんか？現役栄養士が教えます！',
            'image_file_name' => '8snuy2q6wMOwmBJboxNw8zCyMjL3YsZQo5amVO33.jpg',
            'description' => 'お子さんの離乳食はママにとっても悩みの種ですよね？『栄養満点』で『たのしく』『後片付け簡単』な離乳食を作りませんか？質問なんでもOK！育児や家庭の悩みまでなんでも気軽にお話ししてください^ ^
            【実際のメニューの例】
            ①Aさんの場合
            納豆とワカメの味噌汁
            5倍粥
            鯛団子のトマトソースかけ
            キウイヨーグルト

            ②Bさんの場合
            コーンフレークバナナ粥
            豆腐のトマトソースがけ
            いちごヨーグルト
',
            'price' => '8000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'zoom' => 'あり',
            'postage' => 'なし',
            'message_room_id' => null,
            'prefecture_id' => 4,
            'seller_read_id' => null,
            'buyer_read_id' => null,
        ]);
        factory(Item::class)->create([
            'id'      => 10,
            'seller_id'    => 1,
            'buyer_id' => null,
            'secondary_category_id' => 26,
            'item_condition_id' => 1,
            'name' => '【遅い時間でも対応可能】仕事と家庭のお悩みお聞かせください',
            'image_file_name' => 'mXdWEfdHrjh4mv6SaHuKcuWnxlfZzDIQxKu3JthD.jpg',
            'description' => '初めまして！私は5人の子育て経験がある52歳の元気なおばさんです！看護師と臨床心理士の資格を持っています。子育てと仕事を両立することは本当に大変で辛いですよね。日々の忙しさの中でなかなか鬱憤を晴らせない塞ぎ込んでいませんか＞＜ぜひ私とお話ししましょう！人と話すだけでも心が軽くなることは心理学的に証明されていますよ！',
            'price' => '5000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'zoom' => 'あり',
            'postage' => 'なし',
            'message_room_id' => null,
            'prefecture_id' => 4,
            'seller_read_id' => null,
            'buyer_read_id' => null,
        ]);
        factory(Item::class)->create([
            'id'      => 11,
            'seller_id'    => 1,
            'buyer_id' => null,
            'secondary_category_id' => 23,
            'item_condition_id' => 1,
            'name' => '【新品&ZOOM実演】離乳食セットの使い方お教えします！',
            'image_file_name' => 'YPW9F6i3ZxxFMbZ6b2ZiNiXjlWfnu8gLFYFWpMFX.jpg',
            'description' => '使い慣れた食器やキッチン用具とは違い離乳食セットはなかなか難しいですよね？今回は離乳食セットをご購入していただいた方限定でZoomで初めての離乳食をサポートいたします＾＾',
            'price' => '18000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'zoom' => 'あり',
            'postage' => 'なし',
            'message_room_id' => null,
            'prefecture_id' => 4,
            'seller_read_id' => null,
            'buyer_read_id' => null,
        ]);
    }
}
