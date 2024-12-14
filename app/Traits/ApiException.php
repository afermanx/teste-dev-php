<?php

namespace App\Traits;

use App\Exceptions\RevendaMaisException;

trait ApiException
{
    /**
     * Returna a bad request exception.
     */
    public function badRequestException(array|string $exception): void
    {
        throw new RevendaMaisException($exception, 400);
    }

    /**
     * Returna a unauthorized request exception.
     */
    public function unauthorizedRequestException(array|string $exception): void
    {
        throw new RevendaMaisException($exception, 401);
    }

    /**
     * Returna a pre condition failed exception.
     */
    public function preConditionFailedException(array|string $exception): void
    {
        throw new RevendaMaisException($exception, 412);
    }

    /**
     * Return a not found request exception.
     */
    public function notFoundRequestException(array|string $exception): void
    {
        throw new RevendaMaisException($exception, 404);
    }

    public function throwApiException(array|string $exception): void
    {
        throw new RevendaMaisException($exception, 500);
    }
}