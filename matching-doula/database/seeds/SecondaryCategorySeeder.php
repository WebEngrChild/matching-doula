<?php

use Illuminate\Database\Seeder;
use App\Models\SecondaryCategory;

class SecondaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SecondaryCategory::class)->create([
            'id'                  => 1,
            'name'                => 'ワンピース',
            'sort_no'             => 1,
            'primary_category_id' => 1,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 2,
            'name'                => 'トップス',
            'sort_no'             => 2,
            'primary_category_id' => 1,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 3,
            'name'                => 'ボトムス',
            'sort_no'             => 3,
            'primary_category_id' => 1,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 4,
            'name'                => 'コート・アウター',
            'sort_no'             => 4,
            'primary_category_id' => 1,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 5,
            'name'                => '水着',
            'sort_no'             => 5,
            'primary_category_id' => 1,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 6,
            'name'                => 'インナー',
            'sort_no'             => 6,
            'primary_category_id' => 1,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 7,
            'name'                => 'パジャマ',
            'sort_no'             => 7,
            'primary_category_id' => 1,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 8,
            'name'                => 'ヨガウェア',
            'sort_no'             => 8,
            'primary_category_id' => 1,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 9,
            'name'                => 'ベビー服（男の子用）',
            'sort_no'             => 9,
            'primary_category_id' => 2,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 10,
            'name'                => 'ベビー服（女の子用）',
            'sort_no'             => 10,
            'primary_category_id' => 2,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 11,
            'name'                => 'キッズ服（男の子用）',
            'sort_no'             => 11,
            'primary_category_id' => 2,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 12,
            'name'                => 'キッズ服（女の子用）',
            'sort_no'             => 12,
            'primary_category_id' => 2,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 13,
            'name'                => 'ベビーカー本体',
            'sort_no'             => 13,
            'primary_category_id' => 3,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 14,
            'name'                => '収納カバー',
            'sort_no'             => 12,
            'primary_category_id' => 3,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 15,
            'name'                => 'ベッド',
            'sort_no'             => 15,
            'primary_category_id' => 4,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 16,
            'name'                => '布団・枕',
            'sort_no'             => 16,
            'primary_category_id' => 4,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 17,
            'name'                => 'ベービージム',
            'sort_no'             => 17,
            'primary_category_id' => 5,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 18,
            'name'                => 'ラトル・ボール',
            'sort_no'             => 18,
            'primary_category_id' => 5,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 19,
            'name'                => '絵本',
            'sort_no'             => 19,
            'primary_category_id' => 5,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 20,
            'name'                => '人形・ぬいぐるみ',
            'sort_no'             => 20,
            'primary_category_id' => 5,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 21,
            'name'                => '積み木',
            'sort_no'             => 21,
            'primary_category_id' => 5,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 22,
            'name'                => '知育',
            'sort_no'             => 22,
            'primary_category_id' => 5,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 23,
            'name'                => 'こどもの食事',
            'sort_no'             => 23,
            'primary_category_id' => 6,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 24,
            'name'                => '夜泣き',
            'sort_no'             => 24,
            'primary_category_id' => 6,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 25,
            'name'                => 'こどもの健康',
            'sort_no'             => 25,
            'primary_category_id' => 6,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 26,
            'name'                => '仕事との両立',
            'sort_no'             => 26,
            'primary_category_id' => 6,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 27,
            'name'                => '夫婦関係',
            'sort_no'             => 27,
            'primary_category_id' => 6,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 28,
            'name'                => '嫁姑・親族関係',
            'sort_no'             => 28,
            'primary_category_id' => 6,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 29,
            'name'                => 'ママ友関係',
            'sort_no'             => 29,
            'primary_category_id' => 6,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 30,
            'name'                => '保育園・幼稚園',
            'sort_no'             => 30,
            'primary_category_id' => 6,
        ]);
        factory(SecondaryCategory::class)->create([
            'id'                  => 31,
            'name'                => 'その他',
            'sort_no'             => 31,
            'primary_category_id' => 7,
        ]);
    }
}
