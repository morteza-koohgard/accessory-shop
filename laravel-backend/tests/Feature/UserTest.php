<?php

namespace Tests\Feature;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_db_fields(): void
    {
        DB::table('users')->insert([
            'name' => 'test user',
            'email' => 'test user email',
            'password' => 'test user password',
            'mobile' => +1234567890,
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'test user',
            'email' => 'test user email',
            'password' => 'test user password',
            'mobile' => +1234567890,
        ]);
    }

    public function test_register_user_api(): void
    {
        $response = $this->post('/api/register', [
            'name' => 'test user',
            'email' => 'test@test.com',
            'password' => 'password'
        ])->assertStatus(201);

        $response->assertJsonStructure([
            'message',
            'data' => [
                'name',
                'email',
                'token'
            ]
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'test user',
            'email' => 'test@test.com'
        ]);
    }

    public function test_login_user_api(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ])->assertStatus(200);

        $response->assertJsonStructure([
            'message',
            'data' => [
                'name',
                'email',
                'token'
            ]
        ]);

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'name' => 'auth_token'
        ]);
    }

    public function test_logout_api(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->post('/api/logout')->assertStatus(200)->assertJson([
            'message' => 'Successfully logged out'
        ]);

        // check remove user tokens after logout
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id
        ]);
    }

    public function test_send_reset_password_api(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/send-reset-email', [
            'email' => $user->email
        ])->assertStatus(200);

        $response->assertJsonStructure([
            'message'
        ]);

        $this->assertDatabaseHas('password_reset_tokens', [
            'email' => $user->email
        ]);
    }

    public function test_reset_password_api(): void
    {
        $user = User::factory()->create();
        $token = Str::random(60);

        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => Hash::make($token)
        ]);

        $response = $this->post('/api/reset-password', [
            'email' => $user->email,
            'password' => Str::random(10),
            'token' => $token
        ])->assertStatus(200);

        $response->assertJsonStructure([
            'message'
        ]);
    }
}
