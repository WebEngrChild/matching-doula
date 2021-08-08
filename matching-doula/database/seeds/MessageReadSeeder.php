<?php

use App\Models\MessageRead;
use Illuminate\Database\Seeder;

class MessageReadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MessageRead::class)->create([
            'id'      => 1,
            'created_at'    => now(),
            'updated_at' => now(),
        ]);
        factory(MessageRead::class)->create([
            'id'      => 2,
            'created_at'    => now(),
            'updated_at' => now(),
        ]);
        factory(MessageRead::class)->create([
            'id'      => 3,
            'created_at'    => now(),
            'updated_at' => now(),
        ]);
        factory(MessageRead::class)->create([
            'id'      => 4,
            'created_at'    => now(),
            'updated_at' => now(),
        ]);
        factory(MessageRead::class)->create([
            'id'      => 5,
            'created_at'    => now(),
            'updated_at' => now(),
        ]);
        factory(MessageRead::class)->create([
            'id'      => 6,
            'created_at'    => now(),
            'updated_at' => now(),
        ]);
    }
}
