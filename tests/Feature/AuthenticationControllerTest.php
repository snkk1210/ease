<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthenticationControllerTest extends TestCase
{
    /**
     * Authentications画面のテスト
     * 
     * @return void
     */
    public function testIndex(){
        # 未ログイン時のリダイレクト
        $responce = $this->get('auths');
        $responce->assertStatus(302);
        # Authentications画面
        $responce = $this->actingAs(User::find(1))
            ->get('/auths');
        $responce->assertStatus(200)
            ->assertViewIs('authentication')
            ->assertSee('This is Authentications.');
    }

    /**
     * Make Authentication画面のテスト
     * 
     * @return void
     */
    public function testMake(){
        # 未ログイン時のリダイレクト
        $responce = $this->get('auth');
        $responce->assertStatus(302);
        # Make Authentication画面
        $responce = $this->actingAs(User::find(1))
            ->get('/auth');
        $responce->assertStatus(200)
            ->assertViewIs('auth_make')
            ->assertSee('Make Authentication.');
    }
}
