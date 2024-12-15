<?php

namespace App\Http\Controllers\Suppliers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Suppliers\SupplierService;
use App\Http\Requests\Suppliers\CreateSupplierRequest;
use App\Http\Resources\Suppliers\SupplierResource;

class SupplierController extends Controller
{

    public function __construct(public SupplierService $service)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}