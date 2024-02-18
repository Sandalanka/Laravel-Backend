<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_login_with_valid_credentials()
    {
        $user = User::factory()->create();
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(200); 
        $response->assertJsonStructure([
            'success',
            'data' => [
                'token',
                'name',
                'status',
            ],
            'message',
        ]);
    }

    public function test_user_login_with_lnvalid_credentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'invalidpassword',
        ]);
        $response->assertStatus(500); 
    }
}
