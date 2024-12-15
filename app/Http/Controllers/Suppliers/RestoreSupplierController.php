<?php

namespace App\Http\Controllers\Suppliers;

use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class RestoreSupplierController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Supplier $supplier): JsonResponse
    {
        $supplier->restore();
        return $this->noContent();
    }
}
