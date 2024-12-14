<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Resources\Auth\LoginUserResource;

class AuthController extends Controller
{
    public function __construct(public AuthService $service)
    {}
    public function login(LoginUserRequest $request): JsonResponse
    {
        return $this->ok(LoginUserResource::make($this->service->login($request->validated())));
    }
}