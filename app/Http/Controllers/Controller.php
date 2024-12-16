<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponse;
use App\Traits\ApiException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use ApiResponse, ApiException, AuthorizesRequests;
}
