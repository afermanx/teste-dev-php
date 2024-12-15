<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Resources\Suppliers\{
    SupplierResource,
    SupplierResourceCollection,
};
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Suppliers\SupplierService;
use App\Http\Requests\Suppliers\{
    IndexSupplierRequest,
    CreateSupplierRequest,
    UpdateSupplierRequest,
};
use App\Models\Supplier;

class SupplierController extends Controller
{

    public function __construct(public SupplierService $service)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index(IndexSupplierRequest $request): JsonResponse
    {
        return $this->ok( new SupplierResourceCollection($this->service->listAll($request->validated())));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSupplierRequest $request): JsonResponse
    {
        return $this->created(SupplierResource::make($this->service->create($request->validated())));
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier): JsonResponse
    {
        return $this->ok(SupplierResource::make($supplier));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier): JsonResponse
    {
        return $this->ok(SupplierResource::make($this->service->update($request->validated(), $supplier)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier): JsonResponse
    {
        $supplier->delete();
        return $this->noContent();
    }
}
