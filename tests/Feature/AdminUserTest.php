<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUserTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsAdmin()
    {
        $admin = User::factory(['role' => 'admin'])->create();
        $this->actingAs($admin);
    }

    /** @test */
    public function admin_can_create_seller()
    {
        // $this->withoutExceptionHandling();

        // Given we have an admin
        $this->actingAsAdmin();

        // When requesting to create a new seller
        $newUser = User::factory()->raw(['role' => 'seller']);
        // dd($newUser);
        $response = $this->post('/api/v1/admin/users', $newUser);

        // Then we expect 201
        $response->assertStatus(201);

        // Then we expect the user in the database
        unset(
            $newUser['password'],
            $newUser['remember_token'],
            $newUser['email_verified_at']
        );
        $this->assertDatabaseHas('users', $newUser);

        // Then we expect the user in user list
        $response->assertSee($newUser['email']);
    }
}
