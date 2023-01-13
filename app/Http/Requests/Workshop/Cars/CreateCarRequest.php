<?php

namespace App\Http\Requests\Workshop\Cars;

use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
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
            'client_id' => 'required|numeric',
            'brand' => 'required',
            'model' => 'required',
            'seria' => 'sometimes|nullable',
            'generation' => 'sometimes|nullable',
            'notes' => 'sometimes|nullable',
            'car_type' => 'sometimes|nullable',
            'engine' => 'sometimes|nullable',
            'registration_number' => 'required',
            'vin_number' => 'sometimes|nullable',
            'production_date' => 'required',
            'distance' => 'sometimes|nullable',
            'inspection_date' => 'sometimes|nullable',
            'insurance_date' => 'sometimes|nullable',
        ];
    }

    public function messages()
    {
        return [
            'brand.required' => __('Marka samochodu jest wymagana'),
            'model.required' => __('Model samochodu jest wymagany'),
            'registration_number.required' => __('Numery rejestracyjne są wymagane'),
            'production_date.required' => __('Data produkcji jest wymagana'),
        ];
    }
}
