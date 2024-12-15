<?php

namespace App\Enum\Suppliers;

enum DocumentTypeEnum: string
{
    public const CPF = 'cpf';
    public const CNPJ = 'cnpj';

    public static function values(): array
    {
        return [
            self::CPF,
            self::CNPJ,
        ];
    }
}