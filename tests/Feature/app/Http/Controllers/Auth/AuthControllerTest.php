<?php

    namespace Tests\Feature\App\Http\Controllers\Auth;

    use Tests\TestCase;
    use App\Models\User;
    use PHPUnit\Framework\Attributes\Test;
    use Illuminate\Foundation\Testing\RefreshDatabase;

    class AuthControllerTest extends TestCase
    {
        use RefreshDatabase;
        protected function createUser()
        {
            return User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@mail.com',
                'password' => bcrypt('password'),
            ]);
        }

        protected string $baseUrl = '/api/v1';
        #[Test]
        public function it_should_login_a_user(): void
        {

            $data = [
            'email'    => $this->createUser()->email,
            'password' => 'password',
            ];

            $this->postJson( $this->baseUrl . '/auth/login', $data)
                ->assertStatus(200)
                ->assertJson([
                'name' => 'Test User',
                'email' => 'test@mail.com',
                ])
                ->assertJsonStructure([
                'name',
                'email',
                'token',
                ]);
        }
        #[Test]
        public function it_should_not_login_a_user(): void
        {
            $data = [
            'email'    => $this->createUser()->email,
            'password' => 'wrong-password',
            ];

            $this->postJson( $this->baseUrl . '/auth/login', $data)
                ->assertStatus(400)
                ->assertJsonStructure([
                    'error',
                ]);
        }

        #[Test]
        public function it_should_logout_a_user(): void
        {
            // criar um usaurio e autenticar
            $user = $this->createUser();
            $this->actingAs($user);
            $this->postJson( $this->baseUrl . '/users/logout')
                ->assertStatus(204)
                ->assertNoContent();
        }
    }