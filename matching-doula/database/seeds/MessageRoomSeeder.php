<?php

use App\Models\MessageRoom;
use Illuminate\Database\Seeder;

class MessageRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MessageRoom::class)->create([
            'id'      => 1,
            'created_at'    => now(),
            'updated_at' => now(),
        ]);
        factory(MessageRoom::class)->create([
            'id'      => 2,
            'created_at'    => now(),
            'updated_at' => now(),
        ]);
        factory(MessageRoom::class)->create([
            'id'      => 3,
            'created_at'    => now(),
            'updated_at' => now(),
        ]);
    }
}
