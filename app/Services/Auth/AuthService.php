<?php

namespace App\Services\Auth;

use App\Traits\ApiException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthService
{
    use ApiException;
     public function login(array $data): User
    {
        if (! Auth::attempt($data)) {
            $this->badRequestException('Credenciais inválidas');
        }

        $token = Auth::user()->createToken('auth_token')->plainTextToken;
        return Auth::user();

    }
}