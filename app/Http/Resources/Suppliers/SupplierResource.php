<?php

namespace App\Http\Resources\Suppliers;

use Illuminate\Http\Request;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
        'name' => $this->name,
        'fantasy_name' => $this->fantasy_name,
        'document' => $this->document,
        'phone' => $this->phone,
        'address' => $this->address,
        'user' => UserResource::make($this->user)
        ];
    }
}