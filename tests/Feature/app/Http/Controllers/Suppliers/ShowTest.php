<?php

namespace Tests\Feature\app\Http\Controllers\Suppliers;

use App\Models\Supplier;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_should_show_a_supplier(): void
    {
        $user = User::factory()->create();
        $supplier = Supplier::factory()->create([
            'user_id' => $user->id,
            'deleted_at' =>  null
        ]);

        $this->actingAs($user);

        $this->getJson('/api/v1/suppliers/' . $supplier->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                "id",
                "name",
                "fantasy_name",
                "document",
                "phone",
                "address",
                "user",
            ]);
    }
}
