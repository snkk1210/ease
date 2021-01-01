<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PlayBookControllerTest extends TestCase
{
    /**
     * Playbooks画面のテスト
     * 
     * @return void
     */
    public function testIndex(){
        # 未ログイン時のリダイレクト
        $responce = $this->get('/playbooks');
        $responce->assertStatus(302);
        # Playbooks画面
        $responce = $this->actingAs(User::find(1))
            ->get('/playbooks');
        $responce->assertStatus(200)
            ->assertViewIs('playbook')
            ->assertSee('This is Playbooks.');
    }
}
