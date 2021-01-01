<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class MakeControllerTest extends TestCase
{
    /**
     * Make Playbook画面のテスト
     * 
     * @return void
     */
    public function testIndex(){
        # 未ログイン時のリダイレクト
        $responce = $this->get('/make');
        $responce->assertStatus(302);
        # Make Playbook画面
        $responce = $this->actingAs(User::find(1))
            ->get('/make');
        $responce->assertStatus(200)
            ->assertViewIs('make')
            ->assertSee('Make Playbook.');
    }

}
