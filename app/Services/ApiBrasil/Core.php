<?php

namespace App\Services\ApiBrasil;

use Illuminate\Support\Facades\Http;

abstract class Core
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('brasilapi.base_url');
    }

    protected function doGetRequest(string $url)
    {
        $response = Http::get($this->apiUrl . $url);
        if ($response->serverError()) {
            $this->badRequestException('Erro ao processsar a requisição.');
        }
        if ($response->failed()) {
            $statusCode = $response->status();
            if ($statusCode === 404) {
                return '';
            }
            $this->badRequestException('Erro ao processsar a requisição.');
        }
        return $response->json();
    }
}
