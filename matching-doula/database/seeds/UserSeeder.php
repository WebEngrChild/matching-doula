<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'ドゥーラ太郎',
            'email' => 'test@test.test',
            'email_verified_at' => now(),
            'password' => Hash::make('00000000'),
        ]);
        factory(User::class)->create([
            'name' => 'ドゥーラ花子',
            'email' => 'test1@test.test',
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'),
        ]);
        factory(User::class)->create([
            'name' => 'ドゥーラ清子',
            'email' => 'test2@test.test',
            'email_verified_at' => now(),
            'password' => Hash::make('22222222'),
        ]);
    }
}
