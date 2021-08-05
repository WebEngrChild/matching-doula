<?php

use Illuminate\Database\Seeder;
use App\Models\Prefecture;

class PrefectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Prefecture::class)->create([
            'id'                  => 1,
            'name'                => '東京都',
            'sort_no'             => 1,
        ]);
        factory(Prefecture::class)->create([
            'id'                  => 2,
            'name'                => '神奈川県',
            'sort_no'             => 2,
        ]);
        factory(Prefecture::class)->create([
            'id'                  => 3,
            'name'                => '千葉県',
            'sort_no'             => 3,
        ]);
        factory(Prefecture::class)->create([
            'id'                  => 4,
            'name'                => '埼玉県',
            'sort_no'             => 4,
        ]);
    }
}
