<?php
namespace App\Services\ApiBrasil\Modules;

use App\Services\ApiBrasil\Core;

class Company extends Core
{
    /**
     * Serch company by cnpj
     * @param string $cnpj
     * @return mixed
     */
    public function getByCnpj(string $cnpj)
    {
        return $this->doGetRequest("/cnpj/v1/$cnpj");
    }
}
