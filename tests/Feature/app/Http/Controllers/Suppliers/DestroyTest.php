<?php

namespace Tests\Feature\app\Http\Controllers\Suppliers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Supplier;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function destroy()
    {
        $user = User::factory()->create();
        $supplier = Supplier::factory()->create(
            [
                'user_id' => $user->id,
                'deleted_at' =>  null
            ]
        );
        $this->actingAs($user);

        $this->deleteJson('/api/v1/suppliers/' . $supplier->id)
            ->assertStatus(204);

        $this->assertSoftDeleted($supplier);
    }
}
