<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test that a user can log in successfully.
     */
    public function test_user_can_log_in(): void
    {
        // Create a user
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => bcrypt('password123'), // Ensure the password is hashed
        ]);

        // Attempt to log in with the user's credentials
        $response = $this->post('/login', [
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ]);

        // Assert that the user is redirected to the intended page (e.g., dashboard)
        $response->assertRedirect('/dashboard');

        // Assert that the user is authenticated
        $this->assertAuthenticatedAs($user);
    }
}
