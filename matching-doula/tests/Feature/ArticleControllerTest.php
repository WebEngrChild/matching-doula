<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    //商品一覧テスト
    public function testshowItems()
    {
        $response = $this->get(route('top'));

        $response->assertStatus(200)
            ->assertViewIs('items.items');
    }

    //未ログインユーザー出品テスト
    public function testGuestSell()
    {
        $response = $this->get(route('sell'));

        $response->assertRedirect(route('login'));
    }

    //ログイン済みユーザー出品テスト
    public function testAuthSell()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('sell'));

        $response->assertStatus(302);
    }
}
