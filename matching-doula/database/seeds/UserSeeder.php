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
            'name' => 'Reiko',
            'email' => 'test@test.test',
            'email_verified_at' => now(),
            'password' => Hash::make('00000000'),
            'avatar_file_name' => '2Qgaq22hnZFCX0Un6GWrEf9b2gvIZLwaKJCzsJKN.png',
            'activities' => '初めまして！私はReikoと言います。看護大学を卒業、看護師として5年務めました。
            5人の子供を育て上げ現在は生まれた出産直後のママさん達をサポートするお仕事をしています(^ ^)',
            'messages' => '出産や育児は苦労も多く大変な思いをたくさんすると思います。
            少しでも皆さんの支えになれれば良いなと思っています！',
            'activity_image_file_name_1' => 'P5HCgGYU6EZmwszHAaETLeLTzr1nPsdBrGQVghMO.png',
            'activity_image_file_name_2' => 'ApueMUEig9C2JqdmUtz0glww0ZREm68cn4kwImjN.png',
            'activity_image_file_name_3' => 'Dpb8GCoFrgaRLZFBn34AuO8MxKkDJYr9YpVTcKPM.png',
            'image1_description' => '株式会社ままさんサポートの代表を務めています',
            'image2_description' => '5人の娘&息子の出産育児経験（壮絶）をもとにサポートします^ ^',
            'image3_description' => '人と話すことが大好きです！！',
        ]);
        factory(User::class)->create([
            'name' => 'Yuko',
            'email' => 'test1@test.test',
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'),
            'avatar_file_name' => '2Qgaq22hnZFCX0Un6GWrEf9b2gvIZLwaKJCzsJKN.png',
            'activities' => '初めまして！私はReikoと言います。看護大学を卒業、看護師として5年務めました。
            5人の子供を育て上げ現在は生まれた出産直後のママさん達をサポートするお仕事をしています(^ ^)',
            'messages' => '出産や育児は苦労も多く大変な思いをたくさんすると思います。
            少しでも皆さんの支えになれれば良いなと思っています！',
            'activity_image_file_name_1' => 'P5HCgGYU6EZmwszHAaETLeLTzr1nPsdBrGQVghMO.png',
            'activity_image_file_name_2' => 'ApueMUEig9C2JqdmUtz0glww0ZREm68cn4kwImjN.png',
            'activity_image_file_name_3' => 'Dpb8GCoFrgaRLZFBn34AuO8MxKkDJYr9YpVTcKPM.png',
            'image1_description' => '株式会社ままさんサポートの代表を務めています',
            'image2_description' => '5人の娘&息子の出産育児経験（壮絶）をもとにサポートします^ ^',
            'image3_description' => '人と話すことが大好きです！！',
        ]);
        factory(User::class)->create([
            'name' => 'Manami',
            'email' => 'test2@test.test',
            'email_verified_at' => now(),
            'password' => Hash::make('22222222'),
            'avatar_file_name' => '2Qgaq22hnZFCX0Un6GWrEf9b2gvIZLwaKJCzsJKN.png',
            'activities' => '初めまして！私はReikoと言います。看護大学を卒業、看護師として5年務めました。
            5人の子供を育て上げ現在は生まれた出産直後のママさん達をサポートするお仕事をしています(^ ^)',
            'messages' => '出産や育児は苦労も多く大変な思いをたくさんすると思います。
            少しでも皆さんの支えになれれば良いなと思っています！',
            'activity_image_file_name_1' => 'Dpb8GCoFrgaRLZFBn34AuO8MxKkDJYr9YpVTcKPM.png',
            'activity_image_file_name_2' => 'ApueMUEig9C2JqdmUtz0glww0ZREm68cn4kwImjN.png',
            'activity_image_file_name_3' => 'Dpb8GCoFrgaRLZFBn34AuO8MxKkDJYr9YpVTcKPM.png',
            'image1_description' => '株式会社ままさんサポートの代表を務めています',
            'image2_description' => '5人の娘&息子の出産育児経験（壮絶）をもとにサポートします^ ^',
            'image3_description' => '人と話すことが大好きです！！',
        ]);
        factory(User::class)->create([
            'name' => 'Hina',
            'email' => 'test3@test.test',
            'email_verified_at' => now(),
            'password' => Hash::make('33333333'),
            'avatar_file_name' => '2Qgaq22hnZFCX0Un6GWrEf9b2gvIZLwaKJCzsJKN.png',
            'activities' => '初めまして！私はReikoと言います。看護大学を卒業、看護師として5年務めました。
            5人の子供を育て上げ現在は生まれた出産直後のママさん達をサポートするお仕事をしています(^ ^)',
            'messages' => '出産や育児は苦労も多く大変な思いをたくさんすると思います。
            少しでも皆さんの支えになれれば良いなと思っています！',
            'activity_image_file_name_1' => 'P5HCgGYU6EZmwszHAaETLeLTzr1nPsdBrGQVghMO.png',
            'activity_image_file_name_2' => 'ApueMUEig9C2JqdmUtz0glww0ZREm68cn4kwImjN.png',
            'activity_image_file_name_3' => 'Dpb8GCoFrgaRLZFBn34AuO8MxKkDJYr9YpVTcKPM.png',
            'image1_description' => '株式会社ままさんサポートの代表を務めています',
            'image2_description' => '5人の娘&息子の出産育児経験（壮絶）をもとにサポートします^ ^',
            'image3_description' => '人と話すことが大好きです！！',
        ]);
    }
}
