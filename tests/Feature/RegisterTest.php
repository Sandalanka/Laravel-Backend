<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_success()
    {
        $userData = User::factory()->make()->toArray();
        $response = $this->postJson('/api/register', $userData);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' ,
            'message'
        ]);
    }
    
    public function test_registration_with_mssing_fields()
    {
        $response = $this->postJson('/api/register', []);
        $response->assertStatus(200); 
    }

}
