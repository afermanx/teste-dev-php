<?php

namespace App\Http\Resources\Suppliers;

use Illuminate\Http\Request;
use App\Http\Resources\Suppliers\SupplierResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SupplierResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $supplierResource =  SupplierResource::collection($this->collection);
        return [
            'data' => $supplierResource,
            'from' => $this->firstItem(),
            'last_page' => $this->lastPage(),
            'per_page' => $this->perPage(),
            'to' => $this->lastItem(),
            'total' => $this->total(),
            'current_page' => $this->currentPage(),

        ];
    }
}
