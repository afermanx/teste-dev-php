<?php

namespace Tests\Feature\App\Http\Controllers\Suppliers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Supplier;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreTest extends TestCase
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
    #[Test]
    public function it_should_create_a_new_supplier_with_CNPJ(): void
    {
        $user = $this->createUser();
        $this->actingAs($user);
        $data = [
            'name' => 'Test Supplier',
            'user_id' => $user->id,
            'fantasy_name' => 'Test Supplier',
            'document' => [
                'type' => 'cnpj',
                'number' => '03208759000152',
            ],
            'address' => [
                "street" => "RUA DAS FLORES",
                "number" => "123",
                "complement" => "CASA",
                "district" => "CENTRO",
                "city" => "RIO DE JANEIRO",
                "state" => "RIO DE JANEIRO",
                "uf" => "RJ",
                "zip_code" => "12345678"
            ],
            'phone' => [
                'ddd' => '21',
                'number' => '12345678'
            ]
        ];

        $response = $this->postJson('/api/v1/suppliers', $data)->assertStatus(201);
        // Remover o user_id
        $expectedData = $data;
        unset($expectedData['user_id']);
        $response->assertJson($expectedData)
            ->assertJsonStructure([
                'id',
                'name',
                'fantasy_name',
                'document',
                'phone',
                'address',
                'user' => [
                    'id',
                    'name',
                    'email'
                ]

            ]);

    }
    #[Test]
    public function it_should_create_a_new_supplier_with_CPF(): void
    {
        $user = $this->createUser();
        $this->actingAs($user);
        $data = [
            'name' => 'Test Supplier',
            'user_id' => $user->id,
            'fantasy_name' => 'Test Supplier',
            'document' => [
                'type' => 'cpf',
                'number' => '26742120045',
            ],
            'address' => [
                "street" => "RUA DAS FLORES",
                "number" => "123",
                "complement" => "CASA",
                "district" => "CENTRO",
                "city" => "RIO DE JANEIRO",
                "state" => "RIO DE JANEIRO",
                "uf" => "RJ",
                "zip_code" => "12345678"
            ],
            'phone' => [
                'ddd' => '21',
                'number' => '12345678'
            ]
        ];

        $response = $this->postJson('/api/v1/suppliers', $data)->assertStatus(201);
        // Remover o user_id
        $expectedData = $data;
        unset($expectedData['user_id']);
        $response->assertJson($expectedData)
            ->assertJsonStructure([
                'id',
                'name',
                'fantasy_name',
                'document',
                'phone',
                'address',
                'user' => [
                    'id',
                    'name',
                    'email'
                ]
            ]);

    }

    #[Test]
    public function it_should_uniquely_identify_a_supplier(): void
    {
        $user = $this->createUser();
        $this->actingAs($user);
        $data = [
            'name' => 'Test Supplier',
            'user_id' => $user->id,
            'fantasy_name' => 'Test Supplier',
            'document' => [
                'type' => 'cnpj',
                'number' => '03208759000152',
            ],
            'address' => [
                "street" => "RUA DAS FLORES",
                "number" => "123",
                "complement" => "CASA",
                "district" => "CENTRO",
                "city" => "RIO DE JANEIRO",
                "state" => "RIO DE JANEIRO",
                "uf" => "RJ",
                "zip_code" => "12345678"
            ],
            'phone' => [
                'ddd' => '21',
                'number' => '12345678'
            ]
        ];

        $this->postJson('/api/v1/suppliers', $data)->assertStatus(201);
    }
}
