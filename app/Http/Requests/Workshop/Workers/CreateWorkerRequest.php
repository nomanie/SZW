<?php

namespace App\Http\Requests\Workshop\Workers;

use App\Enums\Workshop\ContractTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateWorkerRequest extends FormRequest
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
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'contract_from' => 'required|date',
            'contract_to' => 'sometimes|nullable|date',
            'login' => 'required',
            'phone' => 'string|min:9',
            'contract_type' => Rule::in(ContractTypeEnum::cases()),
            'position' => 'sometimes|nullable',
            'info' => 'sometimes|nullable',
            'salary' => 'sometimes|nullable',
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('Imię jest wymagane'),
            'first_name.string' => __('Imię musi być ciągiem znaków'),
            'first_name.min' => __('Imię jest za krótkie'),
            'last_name.required' => __('Nazwisko jest wymagane'),
            'last_name.string' => __('Nazwisko musi być ciągiem znaków'),
            'last_name.min' => __('Nazwisko jest za krótkie'),
            'contract_from.required' => __('To pole jest wymagane'),
            'contract_from.date' => __('To pole musi być datą'),
            'contract_to.required' => __('To pole jest wymagane'),
            'contract_to.date' => __('To pole musi być datą'),
            'phone.string' => __('Numer telefonu musi być ciągiem znaków'),
            'phone.min' => __('Numer telefonu jest błędny'),
            'login.required' => __('Login jest wymagany'),
            'contract_type.in' => __('Rodzaj umowy jest zły'),
            'email.required' => __('Adres e-mail jest wymagany'),
            'password.required' => __('Hasło jest wymagane'),
        ];
    }
}
