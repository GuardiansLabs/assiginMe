<?php
namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $clientRepository = new ClientRepository();
        $client           = $clientRepository->createPersonalAccessClient(
            null, 'App', 'http://localhost'
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id'  => $client->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

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
            'email'    => 'testtest@email.com',
            'password' => '123456789',
        ];
        factory(User::class)->create([
            'email' => 'testtest@email.com',
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
            'email' => 'test@email.com',
        ]);

        $data = [
            'email'    => 'test@email.com',
            'password' => 'secret',
        ];
        $response = $this->json('POST', 'api/v1/login', $data);
        $response->assertJson([
            'email' => $user->email,
        ]);
    }
}
