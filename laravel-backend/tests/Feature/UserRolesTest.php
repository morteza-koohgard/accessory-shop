<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRolesTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_have_multiple_roles()
    {
        $user = User::factory()->create();
        $adminRole = Role::where('name', 'admin')->first();

        $user->roles()->attach($adminRole->id);

        $this->assertTrue($user->hasRole('admin'));
    }

    /** @test */
    public function a_user_without_roles_cannot_access_protected_routes()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->post('/admin-only-route');

        $response->assertStatus(403);
    }
}
