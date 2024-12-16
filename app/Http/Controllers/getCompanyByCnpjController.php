<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Rules\CheckDocumentNumber;
use Facades\App\Services\ApiBrasil\Modules\Company;

class getCompanyByCnpjController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        // validar cnpj
        $validate = $request->validate([
            'cnpj' => ['required', 'string', new CheckDocumentNumber()],
        ], [
            'cnpj.required' => 'O campo CNPJ é obrigatório',
            'cnpj.string' => 'O campo CNPJ deve ser uma string',
        ]);

        $response = Company::getByCnpj($request->cnpj);
        return $this->ok($response);
    }
}
