<?php

namespace App\Http\Requests\System\Cars;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'brand_popularity' => 'required|in:0,1,2',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Nazwa marki jest wymagana'),
            'brand_popularity.required' => __('Popularność marki jest wymagana'),
            'brand_popularity.in' => __('Popularność marki musi być jedną z opcji')
        ];
    }
}
