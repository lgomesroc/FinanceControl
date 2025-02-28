<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
    }

    /**@test */
    public function test_create_user()
    {


        $data = [
            'name' => 'Luciano Nascimento',
            'email' => 'lucianosantosti@hotmail.com',
            'password' => 'password2025',
        ];

        $user = $this->userService->create($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Luciano Nascimento', $user->name);
        $this->assertEquals('lucianosantosti@hotmail.com', $user->email);
        $this->assertTrue(password_verify('password2025', $user->password));
    }

    public function test_update_user()
    {
        $userService = new UserService();

        $user = User::factory()->create([
            'name' => 'Luciano Nascimento',
            'email' => 'lucianosantosti@hotmail.com',
            'password' => 'password2025',
        ]);

        $data = [
            'name' => 'Lara Mellissa',
            'email' => 'lara@lara.com',
            'password' => 'password2025',
        ];

        $updatedUser = $this->userService->update($user, $data);

        $this->assertEquals('Lara Mellissa', $updatedUser->name);
        $this->assertEquals('lara@lara.com', $updatedUser->email);
        $this->assertTrue(password_verify('password2025', $updatedUser->password));
    }

    public function test_delete_user()
    {
        $user = User::factory()->create([
            'name' => 'Luciano Nascimento',
            'email' => 'lucianosantosti@hotmail.com',
            'password' => 'password2025',
        ]);

        $result = $this->userService->delete($user);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
