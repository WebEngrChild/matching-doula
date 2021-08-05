<?php

use App\Models\MessageUser;
use Illuminate\Database\Seeder;

class MessageUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MessageUser::class)->create([
            'id'      => 1,
            'created_at'    => now(),
            'updated_at' => now(),
            'message_user_id' => 1,
            'message_room_id' => 1,
        ]);
        factory(MessageUser::class)->create([
            'id'      => 2,
            'created_at'    => now(),
            'updated_at' => now(),
            'message_user_id' => 2,
            'message_room_id' => 1,
        ]);
        factory(MessageUser::class)->create([
            'id'      => 3,
            'created_at'    => now(),
            'updated_at' => now(),
            'message_user_id' => 1,
            'message_room_id' => 2,
        ]);
        factory(MessageUser::class)->create([
            'id'      => 4,
            'created_at'    => now(),
            'updated_at' => now(),
            'message_user_id' => 3,
            'message_room_id' => 2,
        ]);
        factory(MessageUser::class)->create([
            'id'      => 5,
            'created_at'    => now(),
            'updated_at' => now(),
            'message_user_id' => 2,
            'message_room_id' => 3,
        ]);
        factory(MessageUser::class)->create([
            'id'      => 6,
            'created_at'    => now(),
            'updated_at' => now(),
            'message_user_id' => 3,
            'message_room_id' => 3,
        ]);
    }
}
