<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'area' => 'required|numeric',
            'price' => 'required|numeric',
            'floors' => 'required|numeric',
            'rooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'heating_id' => 'required|exists:heatings,id',
            'seller_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'featured-c' => 'nullable|boolean',
        ];
    }
}
