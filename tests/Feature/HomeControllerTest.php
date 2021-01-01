<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class HomeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample(){
        # FQDNでのアクセス時にリダイレクト
        $response = $this->get('/');
        $response->assertStatus(302);
    }

    /**
     * ログイン画面のテスト
     * 
     * @return void
     */
    public function testLogin(){
        # ログイン画面
        $responce = $this->get('/login');
        $responce->assertStatus(200)
            ->assertSee('Sign in to start your session');
    }

    /**
     * ホーム画面のテスト
     * 
     * @return void
     */
    public function testIndex(){
        # 未ログイン時のリダイレクト
        $responce = $this->get('/home');
        $responce->assertStatus(302);
        # ホーム画面
        $responce = $this->actingAs(User::find(1))
            ->get('/home');
        $responce->assertStatus(200)
            ->assertViewIs('home')
            ->assertSee('Welcome!!');
    }
}
