<?php

namespace App\Http\Requests\Suppliers;

use App\Rules\CheckDocumentNumber;
use Illuminate\Foundation\Http\FormRequest;

class IndexSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['bail', 'nullable', 'string', 'max:255'],
            'fantasy_name' => ['bail', 'nullable', 'string', 'max:255'],
            'document' => ['bail', 'nullable', 'string', new CheckDocumentNumber()],
            'per_page' => ['bail', 'nullable', 'integer', 'min:5', 'max:100'],
            'order_by' => ['bail', 'nullable', 'string'],
            'order' => ['bail', 'nullable', 'string', 'in:asc,desc'],
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
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'fantasy_name.string' => 'O campo nome fantasia deve ser uma string.',
            'fantasy_name.max' => 'O campo nome fantasia deve ter no máximo 255 caracteres.',
            'document.string' => 'O campo documento deve ser uma string.',
            'per_page.integer' => 'O campo per_page deve ser um inteiro.',
            'per_page.min' => 'O campo per_page deve ter no mínimo 5.',
            'per_page.max' => 'O campo per_page deve ter no.maxcdn 100.',
            'order_by.string' => 'O campo order_by deve ser uma string.',
            'order.in' => 'O campo order deve ser um dos seguintes: asc, desc.',

        ];
    }


}
