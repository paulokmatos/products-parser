<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string',
            'status' => 'required|string',
            'imported_t' => 'required|string',
            'url' => 'required|url',
            'creator' => 'required|string',
            'created_t' => 'required|string',
            'last_modified_t' => 'required|string',
            'product_name' => 'required|string',
            'quantity' => 'required|string',
            'brands' => 'required|string',
            'categories' => 'required|string',
            'labels' => 'required|string',
            'cities' => 'required|string',
            'purchase_places' => 'required|string',
            'stores' => 'required|string',
            'ingredients_text' => 'required|string',
            'traces' => 'required|string',
            'serving_size' => 'required|string',
            'serving_quantity' => 'required|string',
            'nutriscore_score' => 'required|string',
            'nutriscore_grade' => 'required|string',
            'main_category' => 'required|string',
            'image_url' => 'required|url',
        ];
    }
}
