<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $product = $this->route('product');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('products', 'name')->ignore($product)],
            'description' => 'required|string|max:255',
            'price' => 'required|decimal:2|min:1',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id'
        ];
    }
}
