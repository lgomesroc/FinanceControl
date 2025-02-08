<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_api(): void
    {
        $data = [
            'name' => 'Luciano Nascimento',
            'email' => 'lucianosantosti@hotmail.com',
            'password' => 'password2025',
        ];

        $response = $this->postJson('/api/users', $data);

        $response->assertStatus(201)
            ->assertJson(['data' => ['name' => 'Luciano Nascimento',
                'email' => 'lucianosantosti@hotmail.com'],
            ]);
        $this->assertDatabaseHas('users', [
            'email' => 'lucianosantosti@hotmail.com'
        ]);
    }

    public function test_update_user_api()
    {
        $user = User::factory()->create([
            'name' => 'Luciano Nascimento',
            'email' => 'lucianosantosti@hotmail.com',
            'password' => Hash::make('password2025'),
        ]);

        $data = [
            'name' => 'Luciano Nascimento de França',
            'email' => 'lucianosantosti@hotmail.com',
            'password' => 'password2025',
        ];

        $response = $this->putJson("/api/users/{$user->id}", $data);

        $response->assertStatus(200)
            ->assertJson(['data' => ['name' => 'Luciano Nascimento de França',
                'email' => 'lucianosantosti@hotmail.com'],
            ]);
        $this->assertDatabaseHas('users', [
            'email' => 'lucianosantosti@hotmail.com'
        ]);

    }

    public function test_delete_user_api()
    {
        $user = User::factory()->create([
            'name' => 'Luciano Nascimento',
            'email' => 'lucianosantosti@hotmail.com',
            'password' => Hash::make('password2025'),
        ]);

        $response = $this->delete("/api/users/{$user->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);

    }
}
