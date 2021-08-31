<?php

use Illuminate\Database\Seeder;
use App\Models\PrimaryCategory;

class PrimaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PrimaryCategory::class)->create([
            'id'      => 1,
            'name'    => 'マタニティ用ファッション',
            'sort_no' => 1,
        ]);
        factory(PrimaryCategory::class)->create([
            'id'      => 2,
            'name'    => 'お子さん用ファッション',
            'sort_no' => 2,
        ]);
        factory(PrimaryCategory::class)->create([
            'id'      => 3,
            'name'    => 'ベビーカー',
            'sort_no' => 3,
        ]);
        factory(PrimaryCategory::class)->create([
            'id'      => 4,
            'name'    => 'ベビー用寝具',
            'sort_no' => 4,
        ]);
        factory(PrimaryCategory::class)->create([
            'id'      => 5,
            'name'    => 'おもちゃ',
            'sort_no' => 5,
        ]);
        factory(PrimaryCategory::class)->create([
            'id'      => 6,
            'name'    => 'お悩み相談',
            'sort_no' => 6,
        ]);
        factory(PrimaryCategory::class)->create([
            'id'      => 7,
            'name'    => 'イベント',
            'sort_no' => 7,
        ]);
        factory(PrimaryCategory::class)->create([
            'id'      => 8,
            'name'    => 'その他',
            'sort_no' => 8,
        ]);
    }
}
