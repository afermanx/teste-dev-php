<?php

namespace App\Rules;

use App\Enum\Suppliers\DocumentTypeEnum;
use App\Enums\DocumentTypeE;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class CheckDocumentNumber implements DataAwareRule, InvokableRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $documentNumber = str_replace(['.', '-', '/'], '', $value);
        if ($this->data['document']['type'] === DocumentTypeEnum::CPF) {
            $this->checkCpf($documentNumber, $fail);

            return;
        }

        if ($this->data['document']['type'] === DocumentTypeEnum::CNPJ) {
            $this->checkCnpj($documentNumber, $fail);

            return;
        }
    }

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    private function checkCpf($cpf, $fail)
    {
        if (strlen($cpf) != 11 || preg_match("/^{$cpf[0]}{11}$/", $cpf)) {
            return $fail('Número de CPF inválido.');
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $cpf[$i++] * $s--);
        if ($cpf[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return $fail('Número de CPF inválido.');
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $cpf[$i++] * $s--);
        if ($cpf[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return $fail('Número de CPF inválido.');
        }
    }

    /**
     * Check if the CNPJ is valid.
     */
    private function checkCnpj($cnpj, $fail)
    {
        if (strlen($cnpj) != 14) {
            return $fail('Número do CNPJ inválido.');
        }
        if (! is_numeric($cnpj)) {
            return $fail('Número do CNPJ inválido.');
        }
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return $fail('Número do CNPJ inválido.');
        }
        $sum = 0;
        for ($i = 0, $j = 5; $i < 12; $i++) {
            $sum += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $rest = $sum % 11;
        if ($cnpj[12] != ($rest < 2 ? 0 : 11 - $rest)) {
            return $fail('Número do CNPJ inválido.');
        }
        $sum = 0;
        for ($i = 0, $j = 6; $i < 13; $i++) {
            $sum += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $rest = $sum % 11;
        if ($cnpj[13] != ($rest < 2 ? 0 : 11 - $rest)) {
            return $fail('Número do CNPJ inválido.');
        }

        return true;
    }
}