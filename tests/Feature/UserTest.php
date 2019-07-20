<?php
namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanRegister(): void
    {
        $data = [
            'name'     => 'test',
            'email'    => 'test@email.com',
            'password' => '123456789',
        ];
        $response = $this->json('post', 'api/v1/register', $data);

        $response->assertStatus(200);
    }

    public function testRequiredFailedWhileRegister(): void
    {
        $data = [
            'name'     => 'test',
            'password' => '123456789',
        ];
        $response = $this->json('post', 'api/v1/register', $data);
        $response->assertJson([
            'email' => [
                'The email field is required.',
            ],
        ]);
    }

    public function testUserEmailShouldBeUnique(): void
    {
        $data = [
            'name'     => 'test',
            'email'    => 'test@email.com',
            'password' => '123456789',
        ];
        factory(User::class)->create([
            'email' => 'test@email.com',
        ]);
        $response = $this->json('post', 'api/v1/register', $data);
        $response->assertJson([
            'email' => [
                'The email has already been taken.',
            ],
        ]);
    }

    public function testUserCanLogin(): void
    {
        $user = factory(User::class)->create([
            'email'    => 'test@email.com',
        ]);

        $data = [
            'email'    => 'test@email.com',
            'password' => 'secret'
        ];
        $response = $this->json('POST', 'api/v1/login', $data);
        $response->assertJson([
            'email' => $user->email,
        ]);
    }
}
