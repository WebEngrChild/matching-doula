<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;

    //商品一覧
    public function testshowItems() {
            $response = $this->get(route('top'));
            $response->assertStatus(400)
            // $response->assertStatus(200)
            // $response->assertStatus(200)
                ->assertViewIs('items.items');
    }
    //未ログイン出品
    public function testGuestSell() {
            $response = $this->get(route('sell'));
            $response->assertRedirect(route('login'));
    }

    //ログイン済み出品
    public function testAuthSell() {
            $user = factory(User::class)->create();
            $response = $this->actingAs($user)
                ->get(route('sell'));
            $response->assertStatus(400);
            // $response->assertStatus(302);
            // $response->assertStatus(302);
    }
}
