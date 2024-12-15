<?php

namespace Tests\Feature\app\Http\Controllers\Suppliers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Supplier;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected  array $suppliersTest = [];

    // Este método é executado antes de cada teste
    protected function setUp(): void
    {
        parent::setUp();

        // Criação do usuário
        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@mail.com',
            'password' => bcrypt('password'),
        ]);

        $this->suppliersTest = [
            [
                'name' => 'Test',
                'user_id' => $this->user->id,
                'fantasy_name' => 'Test',
                'document' => [
                    'type' => 'cnpj',
                    'number' => '03208759000152'
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
                ],
            ],
            [
                'name' => 'supplier',
                'user_id' => $this->user->id,
                'fantasy_name' => 'supplier',
                'document' => [
                    'type' => 'cpf',
                    'number' => '37799448040'
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
                    'number' => '123456789'
                ],
            ]
        ];
    }

    #[Test]
    public function it_should_return_a_list_of_suppliers(): void
    {
        // Criando fornecedores e associando ao usuário criado
        Supplier::factory(10)->create([
            'user_id' => $this->user->id,
            'deleted_at' =>  null
        ]);

        // Realizando o login com o usuário criado
        $this->actingAs($this->user);

        // Teste
        $this->getJson('/api/v1/suppliers')
            ->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                "data" => [
                    [
                        "id",
                        "name",
                        "fantasy_name",
                        "document",
                        "phone",
                        "address",
                        "user",
                    ]
                ]
            ]);
    }
    public function it_should_list_suppliers_ordered_by_parameter_asc_desc(): void
    {
        // Criando fornecedores e associando ao usuário criado
        Supplier::factory(10)->create([
            'user_id' => $this->user->id,
        ]);

        // Realizando o login com o usuário criado
        $this->actingAs($this->user);

        // Teste
        $this->getJson('/api/v1/suppliers?order_by=name&order=asc')
            ->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                "data" => [
                    [
                        "id",
                        "name",
                        "fantasy_name",
                        "document",
                        "phone",
                        "address",
                        "user",
                    ]
                ]
            ]);

        $this->getJson('/api/v1/suppliers?order_by=name&order=desc')
            ->assertStatus(200)
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                "data" => [
                    [
                        "id",
                        "name",
                        "fantasy_name",
                        "document",
                        "phone",
                        "address",
                        "user",
                    ]
                ]
            ]);

    }
    #[Test]
    public function it_should_list_suppliers_by_filter_name(): void
    {
        foreach ($this->suppliersTest as $supplierData) {
            Supplier::create([
                'name' => $supplierData['name'],
                'user_id' => $supplierData['user_id'],
                'fantasy_name' => $supplierData['fantasy_name'],
                'document' => $supplierData['document'],
                'address' => $supplierData['address'],
                'phone' => $supplierData['phone'],
            ]);
    }
        $this->actingAs($this->user);
       $response =  $this->getJson('/api/v1/suppliers?name=Test')
            ->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonStructure([
                "data" => [
                    [
                        "id",
                        "name",
                        "fantasy_name",
                        "document",
                        "phone",
                        "address",
                        "user",
                    ]
                ]
            ]);

            $responseData = $response->json('data');
            $this->assertEquals('Test', $responseData[0]['name']);
    }
    #[Test]
public function it_should_list_suppliers_by_filter_fantasy_name(): void
{
    // Criando os fornecedores com base nos dados em $suppliersTest
    foreach ($this->suppliersTest as $supplierData) {
        Supplier::create([
            'name' => $supplierData['name'],
            'user_id' => $supplierData['user_id'],
            'fantasy_name' => $supplierData['fantasy_name'],
            'document' => $supplierData['document'],
            'address' =>  $supplierData['address'],
            'phone' => $supplierData['phone'],
        ]);
    }
    $this->actingAs($this->user);
    $response = $this->getJson('/api/v1/suppliers?fantasy_name=Test')
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonStructure([
            "data" => [
                [
                    "id",
                    "name",
                    "fantasy_name",
                    "document",
                    "phone",
                    "address",
                    "user",
                ]
            ]
        ]);
    $responseData = $response->json('data');
    $this->assertEquals('Test', $responseData[0]['fantasy_name']);
}
#[Test]
public function it_should_list_suppliers_by_filter_document(): void
{
    foreach ($this->suppliersTest as $supplierData) {
        $suppliers= Supplier::create([
            'name' => $supplierData['name'],
            'user_id' => $supplierData['user_id'],
            'fantasy_name' => $supplierData['fantasy_name'],
            'document' => $supplierData['document'],
            'address' => $supplierData['address'],
            'phone' => $supplierData['phone'],
        ]);
    }
    $this->actingAs($this->user);
    $response = $this->getJson('/api/v1/suppliers?document=37799448040')
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonStructure([
            "data" => [
                [
                    "id",
                    "name",
                    "fantasy_name",
                    "document",
                    "phone",
                    "address",
                    "user",
                ]
            ]
        ]);
    $responseData = $response->json('data');
    $this->assertEquals('37799448040', $responseData[0]['document']['number']);
}


}
