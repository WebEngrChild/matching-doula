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
            'buyer_id' => 2,
            'secondary_category_id' => 1,
            'item_condition_id' => 1,
            'name' => '太郎と花子',
            'image_file_name' => 'test',
            'description' => '太郎と花子のやりとり',
            'price' => '10000',
            'state' => 'bought',
            'bought_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'message_room_id' => 1,
            'prefecture_id' => 1,
        ]);
        factory(Item::class)->create([
            'id'      => 2,
            'seller_id'    => 1,
            'buyer_id' => 3,
            'secondary_category_id' => 2,
            'item_condition_id' => 2,
            'name' => '太郎と清子',
            'image_file_name' => 'test',
            'description' => '太郎と清子のやりとり',
            'price' => '10000',
            'state' => 'bought',
            'bought_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'message_room_id' => 2,
            'prefecture_id' => 2,
        ]);
        factory(Item::class)->create([
            'id'      => 3,
            'seller_id'    => 2,
            'buyer_id' => 3,
            'secondary_category_id' => 3,
            'item_condition_id' => 3,
            'name' => '花子と清子',
            'image_file_name' => 'test',
            'description' => '花子と清子のやりとり',
            'price' => '10000',
            'state' => 'bought',
            'bought_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'message_room_id' => 3,
            'prefecture_id' => 3,
        ]);
        factory(Item::class)->create([
            'id'      => 4,
            'seller_id'    => 1,
            'buyer_id' => null,
            'secondary_category_id' => 4,
            'item_condition_id' => 4,
            'name' => '太郎と花子',
            'image_file_name' => 'test',
            'description' => '太郎と花子のやりとり(未購入)',
            'price' => '10000',
            'state' => 'selling',
            'bought_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'message_room_id' => null,
            'prefecture_id' => 4,
        ]);
    }
}
