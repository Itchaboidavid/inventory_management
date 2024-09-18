<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
        $supplier = $this->route('supplier');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('suppliers', 'name')->ignore($supplier),
            ],
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|numeric|digits:11',
            'email' => [
                'required',
                'email',
                Rule::unique('suppliers', 'email')->ignore($supplier),
            ],
            'address' => 'required|string|max:255'
        ];
    }
}
