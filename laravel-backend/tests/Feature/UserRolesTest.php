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

    public function test_a_user_without_roles_cannot_access_protected_routes(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;
        $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->post('/api/admin/dashboard')->assertStatus(403);

        $adminRole = Role::where('name', 'admin')->first();
        $user->roles()->attach($adminRole->id);

        $this->withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->post('/api/admin/dashboard')->assertStatus(200);
    }
}
