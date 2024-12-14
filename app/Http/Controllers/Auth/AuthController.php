<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Resources\Auth\LoginUserResource;

class AuthController extends Controller
{
    public function __construct(public AuthService $service)
    {}
    /**
     * login a user
     * @param \App\Http\Requests\Auth\LoginUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        return $this->ok(LoginUserResource::make($this->service->login($request->validated())));
    }

    /**
     * logout a user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    Public function logout(Request $request): JsonResponse
    {
        $this->service->logout($request->user());
        return $this->noContent();
    }
}