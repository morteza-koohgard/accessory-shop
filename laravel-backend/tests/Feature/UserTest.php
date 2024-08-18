<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
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
    }
}
