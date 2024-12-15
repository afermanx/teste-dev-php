<?php

namespace Tests\Feature\app\Http\Controllers\Suppliers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Supplier;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
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
    public function it_should_update_a_supplier(): void
    {
        $user = $this->createUser();
        $supplier = Supplier::factory()->create([
            'user_id' => $user->id,
            'deleted_at' =>  null
        ]);

        $this->actingAs($user);

        $data = [
            'name' => 'Updated Supplier',
            'fantasy_name' => 'Updated Supplier',
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
        $response = $this->patchJson('/api/v1/suppliers/' . $supplier->id, $data)
            ->assertStatus(200);
        $data['id'] = $supplier->id;
        $data['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];

        // Validar o JSON da resposta
        $response->assertJson($data)
            ->assertJsonStructure([
                'id',
                'name',
                'fantasy_name',
                'document',
                'phone',
                'address',
                'user',
            ]);
    }
}
