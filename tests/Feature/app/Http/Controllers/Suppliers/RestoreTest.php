<?php

namespace Tests\Feature\app\Http\Controllers\Suppliers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Supplier;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestoreTest extends TestCase
{
    use RefreshDatabase;
    #[Test]
    public function restore()
    {
        $user = User::factory()->create();
        $supplier = Supplier::factory()->create(
            [
                'user_id' => $user->id,
                'deleted_at' =>  now()
            ]
        );
        $this->actingAs($user);

        $this->postJson('/api/v1/suppliers/' . $supplier->id . '/restore')
            ->assertStatus(204);

            $this->assertNotSoftDeleted($supplier);
    }
}
