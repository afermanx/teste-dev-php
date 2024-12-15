<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Validation\Rule;
use App\Rules\CheckDocumentNumber;
use App\Enum\Suppliers\DocumentTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {

        if (is_array($this->document)) {
            $documentType = data_get($this->document, 'type');
            $mergeData = [
                'document' => [
                    'type' => strtolower($documentType),
                    'number' => data_get($this->document, 'number'),
                ],
            ];

            $this->merge($mergeData);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:255'],
            'fantasy_name' => ['bail', 'nullable', 'string', 'max:255'],
            'document' => ['bail', 'required', 'array:type,number'],
            'document.type' => ['bail', 'required_with:document', 'string', Rule::in(DocumentTypeEnum::CPF, DocumentTypeEnum::CNPJ)],
            'document.number' => ['bail', 'required_with:document', 'string', new CheckDocumentNumber() ],
            'address' => ['bail', 'required', 'array:street,number,complement,district,city,state,uf,zip_code'],
            'address.street' => ['bail', 'required_with:address', 'string', 'max:255'],
            'address.number' => ['bail', 'required_with:address', 'string', 'max:255'],
            'address.complement' => ['bail', 'nullable', 'string', 'max:255'],
            'address.district' => ['bail', 'required_with:address', 'string', 'max:255'],
            'address.city' => ['bail', 'required_with:address', 'string', 'max:255'],
            'address.state' => ['bail', 'required_with:address', 'string', 'max:255'],
            'address.uf' => ['bail', 'required_with:address', 'string', 'max:2'],
            'address.zip_code' => ['bail', 'required_with:address', 'string', 'max:8'],
            'phone' => ['bail', 'required', 'array:ddd,number'],
            'phone.ddd' => ['bail', 'required_with:phone', 'string', 'min:2', 'max:2'],
            'phone.number' => ['bail', 'required_with:phone', 'string', 'min:8', 'max:9'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'document.required' => 'O campo documento é obrigatório.',
            'document.array' => 'O campo documento deve ser um array.',
            'document.type.required_with' => 'O campo tipo de documento é obrigatório.',
            'document.type.string' => 'O campo tipo de documento deve ser uma string.',
            'document.type.in' => 'O campo tipo de documento deve ser um CPF ou CNPJ.',
            'document.number.required_with' => 'O campo numero de documento é obrigatório.',
            'document.number.string' => 'O campo numero de documento deve ser uma string.',
            'document.number.unique' => 'O campo numero de documento deve ser unico.',
            'address.required' => 'O campo endereço é obrigatório.',
            'address.array' => 'O campo endereço deve ser um array.',
            'address.street.required_with' => 'O campo rua é obrigatório.',
            'address.street.string' => 'O campo rua deve ser uma string.',
            'address.street.max' => 'O campo rua deve ter no máximo 255 caracteres.',
            'address.number.required_with' => 'O campo numero é obrigatório.',
            'address.number.string' => 'O campo numero deve ser uma string.',
            'address.number.max' => 'O campo numero deve ter no máximo 255 caracteres.',
            'address.complement.string' => 'O campo complemento deve ser uma string.',
            'address.complement.max' => 'O campo complemento deve ter no máximo 255 caracteres.',
            'address.district.required_with' => 'O campo bairro é obrigatório.',
            'address.district.string' => 'O campo bairro deve ser uma string.',
            'address.district.max' => 'O campo bairro deve ter no máximo 255 caracteres.',
            'address.city.required_with' => 'O campo cidade é obrigatório.',
            'address.city.string' => 'O campo cidade deve ser uma string.',
            'address.city.max' => 'O campo cidade deve ter no máximo 255 caracteres.',
            'address.state.required_with' => 'O campo estado é obrigatório.',
            'address.state.string' => 'O campo estado deve ser uma string.',
            'address.state.max' => 'O campo estado deve ter no máximo 255 caracteres.',
            'address.uf.required_with' => 'O campo uf é obrigatório.',
            'address.uf.string' => 'O campo uf deve ser uma string.',
            'address.uf.max' => 'O campo uf deve ter no máximo 2 caracteres.',
            'address.zip_code.required_with' => 'O campo cep é obrigatório.',
            'address.zip_code.string' => 'O campo cep deve ser uma string.',
            'address.zip_code.max' => 'O campo cep deve ter no.maxcdn 8 caracteres.',
            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.array' => 'O campo telefone deve ser um array.',
            'phone.ddd.required_with' => 'O campo ddd é obrigatório.',
            'phone.ddd.string' => 'O campo ddd deve ser uma string.',
            'phone.ddd.min' => 'O campo ddd deve ter no minimo 2 caracteres.',
            'phone.ddd.max' => 'O campo ddd deve ter no maximo 2 caracteres.',
            'phone.number.required_with' => 'O campo numero de telefone é obrigatório.',
            'phone.number.string' => 'O campo numero de telefone deve ser uma string.',
            'phone.number.min' => 'O campo numero de telefone deve ter no minimo 8 caracteres.',
            'phone.number.max' => 'O campo numero de telefone deve ter no maximo 9 caracteres.',
        ];
    }
}