<?php

namespace App\Http\Requests\Workshop\Clients;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'first_name' => 'required|min:3|',
            'last_name' => 'required|min:3|',
            'phone' => 'sometimes|nullable|min:9',
            'info' => 'sometimes|nullable',
            'email' => 'sometimes|nullable|min:8',
            'zip_code' => 'sometimes|nullable|min:5',
            'building_number' => 'sometimes|nullable',
            'flat_number' => 'sometimes|nullable',
            'city' => 'sometimes|nullable',
            'street' => 'sometimes|nullable',
            'date_of_birth' => 'sometimes|nullable',
            'consent_sms_notification' => 'required|in:0,1',
            'consent_marketing_notification' => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('Imię jest wymagane'),
            'first_name.min' => __('Imię musi mieć minimum 3 znaki'),
            'last_name.required' => __('Nazwisko jest wymagane'),
            'last_name.min' => __('Nazwisko musi mieć minimum 3 znaki'),
            'phone.min' => __('Numer telefonu musi mieć przynajmniej 9 znaków'),
            'email.min' => __('Adres e-mail musi mieć przynajmniej 8 znaków'),
            'zip_code.min' => __('Kod pocztowy musi mieć przynajmniej 5 znaków'),

        ];
    }
}
